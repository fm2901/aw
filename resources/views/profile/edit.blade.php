<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Account Settings /</span> Account
        </h4>
        <form action="{{ route('profile.edit_admin') }}"></form>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4 p-3">
                    <h5 class="card-header">{{ $user->getName() }}</h5>
                    <hr class="my-0">
                    <div class="row">
                        <div class="card-body col-md-5">
                            <h4 class="text-bold">Account manager</h4>
                            <p>Account manager: {{ $user->getName() }}</p>
                            <p>Whatsapp: {{ $user->phone }}</p>
                        </div>
                        <div class="card-body col-md-5">
                            <h4 class="text-bold">Security Deposit</h4>
                            <p>Min. Required Deposit: ${{ $user->deposit_min }}</p>
                            <p>Deposit on File: ${{ $user->deposit_on_file }}</p>
                            <p>Buying Power: ${{ $user->buying_power }}</p>
                        </div>
                        @if($user->type == 1)
                            <div class="card-body col-md-5">
                                <h4 class="text-bold">Business Representative</h4>
                                <p>{{ $user->getName() }}</p>
                                <p>Transfer the vehicle titles to: {{ $user->vehiclesList() }}</p>
                            </div>
                        @endif
                        <div class="card-body col-md-5">
                            <h4 class="text-bold">Address</h4>
                            <p>Street address: {{ $user->street_address }}</p>
                            <p>Suite, Office, Unit #: {{ $user->unit }} </p>
                            <p>City: {{ $user->city }} </p>
                            <p>State: {{ $user->state }} </p>
                            <p>Zip Code: {{ $user->zip }} </p>
                            <p>Country: {{ $user->countryInfo->name }} </p>
                        </div>
                        <div class="card-body col-md-5">
                            <h4 class="text-bold">Contact Info</h4>
                            <p>Email: {{ $user->email }}</p>
                            <p>Phone Number: {{ $user->phone }} </p>
                            <p>WhatsApp: {{ $user->phone }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12">
                <div class="card">
                    <h5 class="card-header">Change password</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.change') }}">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3">
                                <input class="form-control mb-2" type="password" name="password" placeholder="New password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Repeat new password">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account float-end">
                                Change <i class="bx bx-edit-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
