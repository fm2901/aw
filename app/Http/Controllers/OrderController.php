<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DamageLevel;
use App\Models\Make;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request): View
    {  
        return view('orders.index', [
            'orders' => Order::all(),
        ]);
    }

    public function edit(Order $id, Request $request): View
    {
        return view('orders.edit', [
            'order' => Order::find($id),
            'user' => $request->user(),
            'makes' => Make::all(),
            'damageLevels' => DamageLevel::all(),
            'users' => User::all(),
            'orderStates' => OrderState::all(),
            'orderId' => Helper::getRandomIdWithCheck((new Order), 'order_id', 9),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $input_data = $request->all();
        $validator = Validator::make(
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
        }

        $order = Order::create([
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
            'photo' => $filePath
        ]);

        

        return Redirect::route('orders.index');
    }
}
