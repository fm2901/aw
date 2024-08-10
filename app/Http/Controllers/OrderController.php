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

        $queryFilter = [];
        if($request->query('query')) {
            $queryFilter["state"] = $request->query('state');
        }

        $totalRecords = Order::select('count(*) as allcount')->where($filter)->count();
        $rowperpage = 3;
        $curPage = intval($request->get("p")) > 0 ? $request->get("p") : 1;
        $start = ($curPage-1) * $rowperpage;
        $pagesCount = round($totalRecords / $rowperpage,0,PHP_ROUND_HALF_UP);



        $orders = Order::where($filter)
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

        if(isset($request->createPurchase)) {
            return redirect( route('purchases.create') . "?order_id=" . $order->id );
        }

        return redirect( route('orders.index') );
    }


    public function store(Request $request): RedirectResponse
    {
        $input_data = $request->all();
        /*$validator = Validator::make(
            $input_data, [
            'photo.*' => 'required|mimes:jpg,jpeg,png|max:20000'
        ],[
                'photo.*.required' => 'Пожалуйста выберите фотографии',
                'photo.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png',
                'photo.*.max' => 'Максимальный размер файла 20MB',
            ]
        );
        $filePath = "";

        if(!$validator->fails()) {
            $file = $request->file('photo');

            $fileName = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getRealPath());

            $filePath = "/cars/".time()."_".$fileName;
            Storage::put($filePath, $fileContent);
        }*/

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



        return Redirect::route('orders.index');
    }
}
