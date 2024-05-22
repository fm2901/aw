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
            'state' => $request->state
        ]);

        return Redirect::route('orders.index');
    }
}
