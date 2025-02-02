@props([
    'errors',
    'purchasePurposes',
    'carStates',
    'toExport',
    'priceRanges',
    'experiensePeriods',
    'user'
])

<div class="mb-3">
    <label class="form-label">What's the primary purpose of your vehicle purchase?</label>
    @foreach($purchasePurposes as $p)
        <div class="form-check">
            <input type="checkbox"
                   class="d-inline"
                   id="purchase_purposes_{{ $p->id }}"
                   name="purchase_purposes[]"
                   value="{{ $p->id }}"
                @checked(in_array($p->id, old('purchase_purposes', $user->purchasePurposes->pluck('id')->toArray() ?? []))) />
            <label class="form-check-label d-inline" for="purchase_purposes_{{ $p->id }}">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('purchase_purposes')" class="mt-2" />
</div>

<div class="mb-3">
    <label class="form-label">What type of vehicles are you looking to purchase?</label>
    @foreach($carStates as $p)
        <div class="form-check">
            <input type="checkbox"
                   class="d-inline"
                   id="car_states_{{ $p->id }}"
                   name="car_states[]"
                   value="{{ $p->id }}"
                @checked(in_array($p->id, old('car_states', $user->carStates->pluck('id')->toArray() ?? []))) />
            <label class="form-check-label d-inline" for="car_states_{{ $p->id }}">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('car_states')" class="mt-2" />
</div>

<div class="mb-3">
    <label class="form-label">Are you looking to export the vehicles you purchase?</label>
    @foreach($toExport as $p)
        <div class="form-check">
            <input type="checkbox"
                   class="d-inline"
                   id="to_export_{{ $p->id }}"
                   name="to_export[]"
                   value="{{ $p->id }}"
                @checked(in_array($p->id, old('to_export', $user->toExport->pluck('id')->toArray() ?? []))) />
            <label class="form-check-label d-inline" for="to_export_{{ $p->id }}">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('to_export')" class="mt-2" />
</div>

<div class="mb-3">
    <label class="form-label">What is your desired price range?</label>
    @foreach($priceRanges as $p)
        <div class="form-check">
            <input type="checkbox"
                   class="d-inline"
                   id="price_ranges_{{ $p->id }}"
                   name="price_ranges[]"
                   value="{{ $p->id }}"
                @checked(in_array($p->id, old('price_ranges', $user->priceRanges->pluck('id')->toArray() ?? []))) />
            <label class="form-check-label d-inline" for="price_ranges_{{ $p->id }}">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('price_ranges')" class="mt-2" />
</div>

<div class="mb-3">
    <label class="form-label">How many years of experience do you have in the Automotive Industry?</label>
    @foreach($experiensePeriods as $p)
        <div class="form-check">
            <input type="radio"
                   class="d-inline"
                   id="experiense_period_{{ $p->id }}"
                   name="experiense_period"
                   value="{{ $p->id }}"
                @checked(old('experiense_period', $user->experiense_period) == $p->id) />
            <label class="form-check-label d-inline" for="experiense_period_{{ $p->id }}">{{ $p->name }}</label>
        </div>
    @endforeach
    <x-input-error :messages="$errors->get('experiense_period')" class="mt-2" />
</div>
