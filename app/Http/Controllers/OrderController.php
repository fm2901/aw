<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DamageLevel;
use App\Models\Fileble;
use App\Models\Files;
use App\Models\Make;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Imagine\Gd\Imagine;


class OrderController extends Controller
{
    public function index(Request $request): View
    {
       $filter = [];
        if(!$request->user()->hasRole('admin')) {
            $filter["user_id"] = $request->user()->id;
        }

        if($request->query('state') > 0) {
            $filter["state"] = $request->query('state');
        }

        if($request->query('user') > 0 && auth()->user()->hasRole('admin')) {
            $filter["user_id"] = $request->query('user');
        }

        $sort = $request->query('sort') ?? "desc";

        $queryFilter = [];
        if($request->query('query')) {
            $queryFilter["state"] = $request->query('state');
        }
        $totalRecords = Order::select('count(*) as allcount')->where($filter)->count();
        $rowperpage = 10;
        $curPage = intval($request->get("p")) > 0 ? $request->get("p") : 1;
        $start = ($curPage-1) * $rowperpage;
        $pagesCount = ceil($totalRecords / $rowperpage);

        $orders = Order::where($filter)
                            ->orderBy('id', $sort)
                            ->skip($start)
                            ->take($rowperpage)
                            ->get();

        $query = $request->query();
        unset($query["p"]);
        return view('orders.index', [
            'orders' => $orders,
            'allCount'    => $totalRecords,
            'pagesCount'    => $pagesCount,
            'curPage'    => $curPage,
            'query'    => http_build_query($query),
            'state'    => $request->query('state'),
        ]);
    }

    public function create(Request $request): View
    {
        return view('orders.create', [
            'user' => $request->user(),
            'makes' => Make::all(),
            'damageLevels' => DamageLevel::all(),
            'users' => User::all(),
            'orderStates' => OrderState::all(),
            'orderId' => Helper::getRandomIdWithCheck((new Order()), 'purchase_id', 9),
        ]);
    }

    public function edit(Order $order, Request $request): View
    {
        return view('orders.edit', [
            'order' => $order,
            'user' => $request->user(),
            'makes' => Make::all(),
            'damageLevels' => DamageLevel::all(),
            'users' => User::all(),
            'orderStates' => OrderState::all(),
        ]);
    }

    public function update(Order $order, Request $request): RedirectResponse
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'years' => 'string',
            'colors' => 'string',
            'max_miles' => 'int',
            'max_bid' => 'int',
        ]);

        $order->update([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'make' => $request->make,
            'model' => $request->model,
            'years' => $request->years,
            'colors' => $request->colors,
            'max_miles' => $request->max_miles,
            'max_bid' => $request->max_bid,
            'damage_level' => $request->damage_level,
            'notes' => $request->notes,
            'state' => $request->state,
        ]);

        $input_data = $request->all();
        $validator = Validator::make(
            $input_data, [
            'photo.*' => 'required|mimes:jpg,png|max:20000'
        ],[
                'photo.*.required' => 'Пожалуйста выберите фотографии',
                'photo.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png',
                'photo.*.max' => 'Максимальный размер файла 20MB',
            ]
        );

        if($request->file('photo') && !$validator->fails()) {

            foreach($request->file('photo') as $file) {

                $fileName = $file->getClientOriginalName();
                $fileContent = file_get_contents($file->getRealPath());

//                $img = Image::make($file->getRealPath());
//                $img->encode(null, 85);

                $imagine = new Imagine();
                $img = $imagine->open($file->getRealPath());


                $photo = "/cars/" . $fileName;
                //Storage::put($photo, $fileContent);
                $img->save(public_path($photo), ['quality' => 30]);

                $newPhoto = Files::updateOrCreate([
                    'path' => $photo,
                    'created_by' => $request->user()->id,
                ]);

                Fileble::updateOrCreate([
                    'file_id' => $newPhoto->id,
                    'fileble_id' => $order->id,
                    'fileble_type' => Order::class,
                ]);
            }
        }

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if(isset($request->createPurchase)) {
            return redirect( route('purchases.create') . "?order_id=" . $order->id );
        }

        return redirect( route('orders.index') );
    }


    public function store(Request $request): RedirectResponse
    {
        $input_data = $request->all();
        $request->validate([
            'model' => 'required|string|max:255',
            'years' => 'string',
            'colors' => 'string',
            'max_miles' => 'integer',
            'max_bid' => 'integer',
        ], [
            'model.required' => 'Model is required.',
            'years.required' => 'Years is required.',
            'colors.required' => 'Colors is required.',
            'max_miles.required' => 'Max miles is required.',
            'max_bid.required' => 'Max bid is required.',
        ]);

        $userId = $request->user()->hasRole('admin') ? $request->user_id : $request->user()->id;
        $state = $request->user()->hasRole('admin') ? $request->state : 1;

        $order = Order::create([
            'user_id' => $userId,
            'order_id' => $request->order_id,
            'make' => $request->make,
            'model' => $request->model,
            'years' => $request->years,
            'colors' => $request->colors,
            'max_miles' => $request->max_miles,
            'max_bid' => $request->max_bid,
            'damage_level' => $request->damage_level,
            'notes' => $request->notes,
            'state' => $state,
        ]);

        $validator = Validator::make(
            $input_data, [
            'photo.*' => 'required|mimes:jpg,png|max:20000'
        ],[
                'photo.*.required' => 'Пожалуйста выберите фотографии',
                'photo.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png',
                'photo.*.max' => 'Максимальный размер файла 20MB',
            ]
        );

        if($request->file('photo') && !$validator->fails()) {

            foreach($request->file('photo') as $file) {

                $fileName = $file->getClientOriginalName();
                $fileContent = file_get_contents($file->getRealPath());

                $photo = "/cars/" . time() . "_" . $fileName;
                Storage::put($photo, $fileContent);

                $newPhoto = Files::updateOrCreate([
                    'path' => $photo,
                    'created_by' => $request->user()->id,
                ]);

                Fileble::updateOrCreate([
                    'file_id' => $newPhoto->id,
                    'fileble_id' => $order->id,
                    'fileble_type' => Order::class,
                ]);
            }
        }

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        return Redirect::route('orders.index');
    }
}
