<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\AccountType;
use App\Models\CarState;
use App\Models\Country;
use App\Models\ExperiensePeriod;
use App\Models\PriceRange;
use App\Models\Purchasable;
use App\Models\PurchasePurpose;
use App\Models\ToExport;
use App\Models\User;
use App\Models\VehicleTo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Psy\CodeCleaner\UseStatementPass;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($type=null): View
    {
        $countries = Country::all();
        $accountTypes = AccountType::all();
        $vehicleTo = VehicleTo::all();
        $purchasePurposes = PurchasePurpose::all();
        $carStates = CarState::all();
        $toExport = ToExport::all();
        $priceRanges = PriceRange::all();
        $experiensePeriods = ExperiensePeriod::all();
        $user = new User();
        return view('auth.register', compact(['type', 'countries', 'accountTypes', 'vehicleTo', 'purchasePurposes', 'carStates', 'toExport', 'priceRanges', 'experiensePeriods', 'user']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(int $type=0, Request $request): RedirectResponse
    {
        try {


            $request->validate([
                'name' => ['string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'street_address' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'country' => ['required', 'int'],
                'price_ranges' => ['required'],
                'account_type' => ['int'],
                'phone' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $user = User::createUser($type, $request);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('orders.index', absolute: false));
    }
}
