<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\CarState;
use App\Models\Country;
use App\Models\ExperiensePeriod;
use App\Models\Fileble;
use App\Models\Files;
use App\Models\Order;
use App\Models\PriceRange;
use App\Models\Purchasable;
use App\Models\PurchasePurpose;
use App\Models\RoleUser;
use App\Models\ToExport;
use App\Models\User;
use App\Models\VehicleTo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $totalRecords = User::select('count(*) as allcount')->count();
        $rowperpage = 10;
        $curPage = intval($request->get("p")) > 0 ? $request->get("p") : 1;
        $start = ($curPage-1) * $rowperpage;
        $pagesCount = ceil($totalRecords / $rowperpage);

        $users = User::skip($start)
            ->take($rowperpage)
            ->get();

        return view('users.index', [
            'users' => $users,
            'allCount'    => $totalRecords,
            'pagesCount'    => $pagesCount,
            'curPage'    => $curPage,
        ]);
    }

    public function edit($id, Request $request): View
    {
        $user = User::find($id);

        $countries = Country::all();
        $accountTypes = AccountType::all();
        $vehicleTo = VehicleTo::all();
        $purchasePurposes = PurchasePurpose::all();
        $carStates = CarState::all();
        $toExport = ToExport::all();
        $priceRanges = PriceRange::all();
        $experiensePeriods = ExperiensePeriod::all();
        $type = $user->account_type;
        $managers = User::role('Admin')->get();
        return view('users.edit', compact(['type', 'countries', 'accountTypes', 'vehicleTo', 'purchasePurposes', 'carStates', 'toExport', 'priceRanges', 'experiensePeriods', 'user', 'managers']));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
//        $validator = $request->validate([
//            'name' => ['string', 'max:255'],
//            'first_name' => ['required', 'string', 'max:255'],
//            'middle_name' => ['required', 'string', 'max:255'],
//            'last_name' => ['required', 'string', 'max:255'],
//            'street_address' => ['required', 'string', 'max:255'],
//            'apt' => ['required', 'string', 'max:255'],
//            'city' => ['required', 'string', 'max:255'],
//            'state' => ['string', 'max:255'],
//            'country' => ['required', 'int'],
//            'vehicle_to' => ['int'],
//            'account_type' => ['int'],
//            'phone' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//        ]);
//
//        if ($validator->fails()) {
//            dd($validator->errors()->all());
//            return response()->json(["message" => $validator->errors()->all()], 400);
//        }

//        $request->validate([
//            'model' => 'required|string|max:255',
//            'years' => 'string',
//            'colors' => 'string',
//            'max_miles' => 'int',
//            'max_bid' => 'int',
//        ]);
//

        $data = [
            "manager" => $request->manager,
            "name" => $request->name ?? '',
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "street_address" => $request->street_address,
            "zip" => $request->zip,
            "apt" => $request->apt,
            "city" => $request->city,
            "state" => $request->state,
            "country" => $request->country,
            "vehicle_to" => $request->vehicle_to ?? 0,
            "phone" => $request->phone,
            "email" => $request->email,
            "experiense_period" => $request->experiense_period,
        ];

        if(auth()->user()->can('edit users')) {
            $data['deposit_min'] = $request->deposit_min ?? 0;
            $data['deposit'] = $request->deposit ?? 0;
            $data['buy_power'] = $request->buy_power ?? 0;
        }

        $user = User::where("id", $id)->update($data);

        Purchasable::updateList($request, $id);

        if($request->role == 1) {
            RoleUser::firstOrCreate([
                'user_id' => $id,
                'role_id' => 1
            ]);
        } else {
            RoleUser::where("user_id", $id)->where('role_id', 1)->delete();
        }


        $input_data = $request->all();
        $validator = Validator::make(
            $input_data, [
            'files.*' => 'required|mimes:jpg,png,pdf,doc,rtf|max:20000'
        ],[
                'files.*.required' => 'Пожалуйста выберите фотографии',
                'files.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png, pdf, doc, rtf',
                'files.*.max' => 'Максимальный размер файла 20MB',
            ]
        );

        if($request->file('files') && !$validator->fails()) {

            foreach($request->file('files') as $file) {

                $fileName = $file->getClientOriginalName();
                $fileContent = file_get_contents($file->getRealPath());

                $photo = "/docs/" . time() . "_" . $fileName;
                Storage::put($photo, $fileContent);

                $newPhoto = Files::updateOrCreate([
                    'path' => $photo,
                    'created_by' => $request->user()->id,
                ]);

                Fileble::updateOrCreate([
                    'file_id' => $newPhoto->id,
                    'fileble_id' => $id,
                    'fileble_type' => User::class,
                ]);
            }
        }


        if(isset($request->password)) {
            User::where("id", $id)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return Redirect::route('users.index');
    }
}
