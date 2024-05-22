<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DamageLevel;
use App\Models\Make;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function index(Request $request): View
    {
        return view('purchases.index', [
            'purchases' => Purchase::all(),
        ]);
    }

    public function show(int $id): View
    {
        return view('purchases.show', [
            'purchase' => Purchase::find($id),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('purchases.edit', [
            'user' => $request->user(),
            'makes' => Make::all(),
            'users' => User::all(),
            'purchaseId' => Helper::getRandomIdWithCheck((new Purchase), 'purchase_id', 10),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Purchase::create([
            'user_id' => $request->user_id,
            'purchase_id' => $request->purchase_id,
            'title' => $request->title,
            'vin' => $request->vin,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'trim' => $request->trim,
            'award_date' => $request->award_date,
            'auction' => $request->auction,
            'auction_location' => $request->auction_location,
            'lot' => $request->lot,
            'balance' => $request->balance,
            'notes' => $request->notes
        ]);

        return Redirect::route('purchases.index');
    }
}
