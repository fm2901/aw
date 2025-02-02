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
use Illuminate\Validation\ValidationException;
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
    public function store(Request $request, ?int $type = 0): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['nullable', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'street_address' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'country' => ['required', 'integer', 'exists:countries,id'],
                'price_ranges' => ['required', 'array'],
                'price_ranges.*' => ['integer', 'min:0'], // Ensuring array values are valid
                'account_type' => ['nullable', 'integer', 'in:1,2,3'], // Restrict to predefined values
                'phone' => ['required', 'string', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'purchase_purposes' => ['required', 'array'],
                'car_states' => ['required', 'array'],
                'to_export' => ['required', 'array'],
                'experiense_period' => ['required', 'string'],
                'terms' => ['required', 'string'],

            ], [
                    'name.required' => 'Name is required.',
                    'first_name.required' => 'First name is required.',
                    'last_name.required' => 'Last name is required.',
                    'street_address.required' => 'Street address is required.',
                    'city.required' => 'City is required.',
                    'country.required' => 'Country is required.',
                    'country.exists' => 'The selected country is invalid.',
                    'price_ranges.required' => 'Price range is required.',
                    'account_type.required' => 'Account type is required.',
                    'phone.required' => 'Phone number is required.',
                    'phone.regex' => 'Invalid phone number format.',
                    'email.required' => 'Email is required.',
                    'email.email' => 'Enter a valid email address.',
                    'email.unique' => 'This email address is already in use.',
                    'password.required' => 'Password is required.',
                    'password.confirmed' => 'Passwords do not match.',
                    'purchase_purposes.required' => 'Purchase purpose is required.',
                    'car_states.required' => 'Car state is required.',
                    'to_export.required' => 'You must specify whether the car is for export.',
                    'experiense_period.required' => 'Experience period is required.',
                    'terms.required' => 'You must accept the terms of use.',
                ]
            );
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }

        $user = User::createUser($type, $request);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('orders.index', absolute: false));
    }

}
