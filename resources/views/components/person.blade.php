@props([
    'errors',
    'countries',
    'user'
])

<div class="mb-3">
    <label for="first_name" class="form-label">First name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name ?? '') }}" placeholder="Enter your first name" autofocus/>
    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="middle_name" class="form-label">Middle name</label>
    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name', $user?->middle_name) }}" placeholder="Enter your middle name"/>
    <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="last_name" class="form-label">Last name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user?->last_name) }}" placeholder="Enter your last name"/>
    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="street_address" class="form-label">Street address</label>
    <input type="text" class="form-control" id="street_address" name="street_address" value="{{ old('street_address', $user?->street_address) }}" placeholder="Enter your street address"/>
    <x-input-error :messages="$errors->get('street_address')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="apt" class="form-label">Apt, Unit</label>
    <input type="text" class="form-control" id="apt" name="apt" value="{{ old('apt', $user?->apt) }}" placeholder="Enter your apt unit"/>
    <x-input-error :messages="$errors->get('apt')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $user?->city) }}" placeholder="Enter city name"/>
    <x-input-error :messages="$errors->get('city')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="state" class="form-label">State</label>
    <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $user?->state) }}" placeholder="Enter state name"/>
    <x-input-error :messages="$errors->get('state')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <select name="country" class="form-control">
        @foreach($countries as $c)
            <option value="{{ $c->id }}" {{ old('country', $user?->country) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('country')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="zip" class="form-label">Zip code</label>
    <input type="number" class="form-control" id="zip" name="zip" value="{{ old('zip', $user?->zip) }}" placeholder="Enter zip code"/>
    <x-input-error :messages="$errors->get('zip')" class="mt-2" />
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone number</label>
    <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone', $user?->phone) }}" placeholder="Enter phone number"/>
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>
