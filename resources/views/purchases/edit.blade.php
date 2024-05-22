<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 p-3">
                    <h2 class="card-header">Create new purchase</h2>
                    <small class="mb-3  col-md-3 col-sm-8">Please limit adding 1 vehicle per order. If you would like to add more than 1 vehicle, create separate orders to avoid delays.</small>
                    <hr class="my-0">
                    <form action="{{ route('purchases.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="purchase_id" class="form-label">Purchase ID</label>
                                    <input type="text" class="form-control" name="purchase_id" value="{{ $purchaseId }}" :value="{{ old('purchase_id') }}">
                                    <x-input-error :messages="$errors->get('purchase_id')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Client</label>
                                    <select name="user_id" class="form-control" required >
                                        {{!!\App\Helpers\Helper::getOptions($users)!!}}
                                    </select>
                                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="vin" class="form-label">VIN</label>
                                    <input type="text" class="form-control" name="vin" :value="{{ old('vin') }}">
                                    <x-input-error :messages="$errors->get('vin')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" :value="{{ old('title') }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="make" class="form-label">Desired Make</label>
                                    <select name="make" class="form-control" required >
                                        {{!!\App\Helpers\Helper::getOptions($makes)!!}}
                                    </select>
                                    <x-input-error :messages="$errors->get('make')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="model" class="form-label">Desired Model</label>
                                    <input type="text" class="form-control" name="model" :value="{{ old('model') }}">
                                    <x-input-error :messages="$errors->get('model')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="year" class="form-label">Desired Year Range</label>
                                    <input type="number" class="form-control" name="year" :value="{{ old('year') }}">
                                    <x-input-error :messages="$errors->get('year')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="trim" class="form-label">Trim</label>
                                    <input type="text" class="form-control" name="trim" :value="{{ old('trim') }}">
                                    <x-input-error :messages="$errors->get('trim')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="award_date" class="form-label">Award Date</label>
                                    <input type="date" class="form-control" name="award_date" :value="{{ old('award_date') }}">
                                    <x-input-error :messages="$errors->get('award_date')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="auction" class="form-label">Auction</label>
                                    <input type="text" class="form-control" name="auction" :value="{{ old('auction') }}">
                                    <x-input-error :messages="$errors->get('auction')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="auction_location" class="form-label">Auction Location</label>
                                    <input type="text" class="form-control" name="auction_location" :value="{{ old('auction_location') }}">
                                    <x-input-error :messages="$errors->get('auction_location')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="lot" class="form-label">Lot number</label>
                                    <input type="number" class="form-control" name="lot" :value="{{ old('lot') }}">
                                    <x-input-error :messages="$errors->get('lot')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="balance" class="form-label">Balance</label>
                                    <input type="number" class="form-control" name="balance" :value="{{ old('balance') }}">
                                    <x-input-error :messages="$errors->get('balance')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="invoice" class="form-label">Invoice</label>
                                    <input type="text" class="form-control" name="invoice" :value="{{ old('invoice') }}">
                                    <x-input-error :messages="$errors->get('invoice')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="max_bid" class="form-label">Notes</label>
                                    <textarea name="notes" class="form-control" cols="30" rows="10">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('max_bid')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
