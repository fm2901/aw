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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
        return view('auth.register', compact(['type', 'countries', 'accountTypes', 'vehicleTo', 'purchasePurposes', 'carStates', 'toExport', 'priceRanges', 'experiensePeriods']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(int $type=0, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:255'],
            'apt' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['string', 'max:255'],
            'country' => ['required', 'int'],
            'vehicle_to' => ['int'],
            'account_type' => ['int'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::createUser($type, $request);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
