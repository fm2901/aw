<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <form action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-4 p-3">

                        <h2 class="text-center">
                            <a class="purchase-title" href="{{ route('orders.index') }}">
                                <img src="/arrow-back.svg" alt="">
                            </a>
                            Create new order</h2>
                        <div class="mb-3 text-center">
                            <code class="text-dark">
                                Please limit adding 1 vehicle per order. If you would like to add more than 1 vehicle,
                                create
                                separate orders to avoid delays.
                            </code>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="order_id" class="form-label">Order ID</label>
                                        <input type="text" class="form-control" name="order_id" value="{{ $orderId }}"
                                               :value="{{ old('order_id') }}"
                                                @if(!auth()->user()->hasRole('admin'))
                                                    readonly
                                                @endif
                                        >
                                        <x-input-error :messages="$errors->get('order_id')" class="mt-2"/>
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                    <div class="col-md-6 col-lg-8 col-sm-12">
                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Client</label>
                                            <select name="user_id" class="form-control" required>
                                                {{!!\App\Helpers\Helper::getOptions($users)!!}}
                                            </select>
                                            <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="make" class="form-label">Desired Make</label>
                                        <select name="make" class="form-control" required>
                                            {{!!\App\Helpers\Helper::getOptions($makes)!!}}
                                        </select>
                                        <x-input-error :messages="$errors->get('make')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="model" class="form-label">Desired Model</label>
                                        <input type="text" class="form-control" name="model"
                                               :value="{{ old('model') }}">
                                        <x-input-error :messages="$errors->get('model')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="years" class="form-label">Desired Year Range</label>
                                        <input type="text" class="form-control" name="years"
                                               :value="{{ old('years') }}">
                                        <x-input-error :messages="$errors->get('years')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="colors" class="form-label">Desired Colors</label>
                                        <input type="text" class="form-control" name="colors"
                                               :value="{{ old('colors') }}">
                                        <x-input-error :messages="$errors->get('colors')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="max_miles" class="form-label">Desired Max Miles</label>
                                <input type="number" class="form-control" name="max_miles"
                                       :value="{{ old('max_miles') }}">
                                <x-input-error :messages="$errors->get('max_miles')" class="mt-2"/>
                            </div>
                            <div class="mb-3">
                                <label for="max_bid" class="form-label">Desired Max Bid</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button disabled class="btn btn-outline-secondary form-control" type="button">USD</button>
                                    </div>
                                    <input type="number" class="form-control" name="max_bid" :value="{{ old('max_bid') }}">
                                    <x-input-error :messages="$errors->get('max_bid')" class="mt-2"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="damage_level" class="form-label">Damage Level</label>
                                        <select name="damage_level" class="form-control" required>
                                            {{!!\App\Helpers\Helper::getOptions($damageLevels)!!}}
                                        </select>
                                        <x-input-error :messages="$errors->get('damage_level')" class="mt-2"/>
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="state" class="form-label">Order state</label>
                                            <select name="state" class="form-control" required>
                                                {{!!\App\Helpers\Helper::getOptions($orderStates)!!}}
                                            </select>
                                            <x-input-error :messages="$errors->get('state')" class="mt-2"/>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="max_bid" class="form-label">Notes</label>
                                <textarea name="notes" class="form-control" cols="15"
                                          rows="3">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2"/>
                            </div>
                            <div class="mb-3">
                                <label for="max_bid" class="form-label d-block mb-2">Upload sample photo</label>
                                <input type="file" name="photo[]">
                                <x-input-error :messages="$errors->get('photo')" class="mt-2"/>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-md-4">

                                <button class="btn btn-primary float-end">Create</button>
                                <a href="{{ route("orders.index") }}" class="btn btn-secondary float-end d-block" style="margin-right: 10px">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
