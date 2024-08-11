@props([
    'errors',
    'countries',
    'user'
])

<div class="mb-3">
    <label for="first_name" class="form-label">First name</label>
    <input type="text" class="form-control" required  id="first_name" name="first_name" value="{{ $user->first_name ?? '' }}" placeholder="Enter your first name" autofocus/>
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="middle_name" class="form-label">Middle name</label>
    <input type="text" class="form-control" required  id="middle_name" name="middle_name" value="{{ $user?->middle_name }}" placeholder="Enter your middle name"/>
    <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="last_name" class="form-label">Last name</label>
    <input type="text" class="form-control" required  id="last_name" name="last_name" value="{{ $user?->last_name }}" placeholder="Enter your last name"/>
    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="street_address" class="form-label">Street address</label>
    <input type="text" class="form-control" required  id="street_address" name="street_address" value="{{ $user?->street_address }}" placeholder="Enter your street address"/>
    <x-input-error :messages="$errors->get('street_address')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="apt" class="form-label">Apt, Unit</label>
    <input type="text" class="form-control" required  id="apt" name="apt" value="{{ $user?->apt }}" placeholder="Enter your apt unit"/>
    <x-input-error :messages="$errors->get('apt')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" required  id="city" name="city" value="{{ $user?->city }}" placeholder="Enter city name"/>
    <x-input-error :messages="$errors->get('city')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="state" class="form-label">State</label>
    <input type="text" class="form-control" required  id="state" name="state" value="{{ $user?->state }}" placeholder="Enter state name"/>
    <x-input-error :messages="$errors->get('state')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <select name="country" class="form-control" required >
        @foreach($countries as $c)
            <option value="{{ $c->id }}" @php if($user?->country == $c->id) echo "selected" @endphp>{{ $c->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('country')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="zip" class="form-label">Zip code</label>
    <input type="number" class="form-control" id="zip" name="zip" value="{{ $user?->zip }}" placeholder="Enter zip code"/>
    <x-input-error :messages="$errors->get('zip')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Phone number</label>
    <input type="number" class="form-control" required  id="phone" name="phone" value="{{ $user?->phone }}" placeholder="Enter phone number"/>
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>
