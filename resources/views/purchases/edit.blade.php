<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <form action="{{ route('purchases.update', ['purchase' => $purchase]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4 p-3">

                        <h2 class="text-center">
                            <a class="purchase-title" href="{{ route('purchases.index') }}">
                                <img src="/arrow-back.svg" alt="">
                            </a>
                            Edit purchase
                        </h2>
                        <div class="mb-3 text-center">
                            <code class="text-dark">
                            </code>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                               <div class="col-md-6 col-lg-4 col-sm-12">
                                   <div class="mb-3">
                                        <label for="purchase_id" class="form-label">Purchase ID</label>
                                        <input type="text" class="form-control" name="purchase_id" value="{{ $purchase->purchase_id }}"
                                               :value="{{ old('purchase_id') }}">
                                        <x-input-error :messages="$errors->get('purchase_id')" class="mt-2"/>
                                   </div>
                               </div>
                               <div class="col-md-6 col-lg-8 col-sm-12">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Client</label>
                                        <select name="user_id" class="form-control" required>
                                            {{!!\App\Helpers\Helper::getOptions($users)!!}}
                                        </select>
                                        <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="order_id" class="form-label">Order ID</label>
                                        <input type="text" class="form-control" name="order_id" value="{{ $purchase->order_id }}"
                                               :value="{{ old('order_id') }}">
                                        <x-input-error :messages="$errors->get('order_id')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-lg-8 col-sm-12">
                                    <div class="mb-3">
                                        <label for="vin" class="form-label">VIN</label>
                                        <input type="text" class="form-control" name="vin" :value="{{ old('vin') }}" value="{{ $purchase->vin }}">
                                        <x-input-error :messages="$errors->get('vin')" class="mt-2"/>
                                    </div>
                                </div>
                                <!---<div class="col-lg-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" :value="{{ old('title') }}" value="{{ $purchase->title }}">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                                    </div>
                                </div>-->
                                <div class="mb-3">
                                    <label for="make" class="form-label">Make</label>
                                    <select name="make" class="form-control" required>
                                        {{!!\App\Helpers\Helper::getOptions($makes, $purchase->make)!!}}
                                    </select>
                                    <x-input-error :messages="$errors->get('make')" class="mt-2"/>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="model" class="form-label">Model</label>
                                        <input type="text" class="form-control" name="model" :value="{{ old('model') }}" value="{{ $purchase->model }}">
                                        <x-input-error :messages="$errors->get('model')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <input type="number" class="form-control" name="year" :value="{{ old('year') }}" value="{{ $purchase->year }}">
                                        <x-input-error :messages="$errors->get('year')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="trim" class="form-label">Trim</label>
                                        <input type="text" class="form-control" name="trim" :value="{{ old('trim') }}" value="{{ $purchase->trim }}">
                                        <x-input-error :messages="$errors->get('trim')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="award_date" class="form-label">Award Date</label>
                                        <input type="date" class="form-control" name="award_date"
                                               :value="{{ old('award_date') }}" value="{{ $purchase->award_date }}">
                                        <x-input-error :messages="$errors->get('award_date')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="auction" class="form-label">Auction</label>
                                        <input type="text" class="form-control" name="auction" :value="{{ old('auction') }}" value="{{ $purchase->auction }}">
                                        <x-input-error :messages="$errors->get('auction')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="auction_location" class="form-label">Auction Location</label>
                                        <input type="text" class="form-control" name="auction_location"
                                               :value="{{ old('auction_location') }}" value="{{ $purchase->auction_location }}">
                                        <x-input-error :messages="$errors->get('auction_location')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="lot" class="form-label">Lot number</label>
                                        <input type="number" class="form-control" name="lot" :value="{{ old('lot') }}" value="{{ $purchase->lot }}">
                                        <x-input-error :messages="$errors->get('lot')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="balance" class="form-label">Balance</label>
                                        <input type="number" class="form-control" name="balance" :value="{{ old('balance') }}" value="{{ $purchase->balance }}">
                                        <x-input-error :messages="$errors->get('balance')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="invoice" class="form-label">Invoice</label>
                                    <input type="file" class="form-control" name="invoice" :value="{{ old('invoice') }}">
                                    <x-input-error :messages="$errors->get('invoice')" class="mt-2"/>
                                </div>
                                <div class="mb-3">
                                    <label for="invoice" class="form-label">Photos</label>
                                    <input type="file" class="form-control" name="photo[]" multiple :value="{{ old('photo') }}">
                                    <x-input-error :messages="$errors->get('photo')" class="mt-2"/>
                                </div>
                                <div class="mb-3">
                                    <label for="max_bid" class="form-label">Notes</label>
                                    <textarea name="notes" class="form-control" cols="15" placeholder="..."
                                              rows="3">{{ old('notes') }} {{ $purchase->notes }}</textarea>
                                    <x-input-error :messages="$errors->get('max_bid')" class="mt-2"/>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-6 col-md-4">
                                <button class="btn btn-primary float-end">Save</button>
                                <a href="{{ route("purchases.index") }}" class="btn btn-secondary float-end d-block" style="margin-right: 10px">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
