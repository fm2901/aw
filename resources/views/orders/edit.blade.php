<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 p-3">
                    <h2 class="card-header">Create new order</h2>
                    <small class="mb-3  col-md-6 col-sm-12">Please limit adding 1 vehicle per order. If you would like to add more than 1 vehicle, create separate orders to avoid delays.</small>
                    <hr class="my-0">
                    <form action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_id" class="form-label">Order ID</label>
                                    <input type="text" class="form-control" name="order_id" value="{{ $orderId }}" :value="{{ old('order_id') }}">
                                    <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Client</label>
                                    <select name="user_id" class="form-control" required >
                                        {{!!\App\Helpers\Helper::getOptions($users)!!}}
                                    </select>
                                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
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
                                    <label for="years" class="form-label">Desired Year Range</label>
                                    <input type="text" class="form-control" name="years" :value="{{ old('years') }}">
                                    <x-input-error :messages="$errors->get('years')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="colors" class="form-label">Desired Colors</label>
                                    <input type="text" class="form-control" name="colors" :value="{{ old('colors') }}">
                                    <x-input-error :messages="$errors->get('colors')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="max_miles" class="form-label">Desired Max Miles</label>
                                    <input type="text" class="form-control" name="max_miles" :value="{{ old('max_miles') }}">
                                    <x-input-error :messages="$errors->get('max_miles')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="max_bid" class="form-label">Desired Max Bid</label>
                                    <input type="text" class="form-control" name="max_bid" :value="{{ old('max_bid') }}">
                                    <x-input-error :messages="$errors->get('max_bid')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="max_bid" class="form-label">Desired Max Bid</label>
                                    <input type="text" class="form-control" name="max_bid" :value="{{ old('max_bid') }}">
                                    <x-input-error :messages="$errors->get('max_bid')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="damage_level" class="form-label">Damage Level</label>
                                    <select name="damage_level" class="form-control" required >
                                        @foreach($damageLevels as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('damage_level')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="state" class="form-label">Order state</label>
                                    <select name="state" class="form-control" required >
                                        @foreach($orderStates as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="max_bid" class="form-label">Notes</label>
                                    <textarea name="notes" class="form-control" cols="30" rows="10">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>
                                <div class="mb-3">
                                    <label for="max_bid" class="form-label d-block mb-2">Upload sample photo</label>
                                    <input type="file" name="photo">
                                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
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
