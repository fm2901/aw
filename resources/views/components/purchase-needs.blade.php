@props([
    'errors',
    'purchasePurposes',
    'carStates',
    'toExport',
    'priceRanges',
    'experiensePeriods',
])

<div class="mb-3">
    <label for="first_name" class="form-label">What's the primary purpose of your vehicle purchase?</label>
    @foreach($purchasePurposes as $p)
        <div class="form-check">
            <input type="checkbox" class="d-inline"  id="purchase_purposes" name="purchase_purposes[]" value="{{ $p->id }}"/>
            <label class="form-check-label d-inline" for="vehicle_to">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('purchase_purposes')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="first_name" class="form-label">What type of vehicles are you looking to purchase?</label>
    @foreach($carStates as $p)
        <div class="form-check">
            <input type="checkbox" class="d-inline"  id="car_states" name="car_states[]" value="{{ $p->id }}"/>
            <label class="form-check-label d-inline" for="car_states">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('purchase_purposes')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="first_name" class="form-label">Are you looking to export the vehicles you purchase?</label>
    @foreach($toExport as $p)
        <div class="form-check">
            <input type="checkbox" class="d-inline"  id="to_export" name="to_export[]" value="{{ $p->id }}"/>
            <label class="form-check-label d-inline" for="to_export">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('purchase_purposes')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="first_name" class="form-label">What is your desired price range?</label>
    @foreach($priceRanges as $p)
        <div class="form-check">
            <input type="checkbox" class="d-inline"  id="price_ranges" name="price_ranges[]" value="{{ $p->id }}"/>
            <label class="form-check-label d-inline" for="price_ranges">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('purchase_purposes')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="first_name" class="form-label">How many years of experience do you have in the Automotive Industry?</label>
    @foreach($experiensePeriods as $p)
        <div class="form-check">
            <input type="radio" class="d-inline"  id="experiense_periods" name="experiense_periods" value="{{ $p->id }}"/>
            <label class="form-check-label d-inline" for="experiense_periods">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('purchase_purposes')" class="mt-2" />
</div>
