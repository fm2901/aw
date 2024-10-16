<x-guest-layout>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="text-center mb-5">
                            <a class="purchase-title" href="{{ env('LANDING_LINK') }}">
                                <img src="/arrow-back.svg" alt="">
                            </a>
                            <a href="{{ route('orders.index')}}">
                                <img src="logo.png" class="w-75" alt="">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 text-black fs-3 text-center mt-5">Reset your pssword</h4>

                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form id="formAuthentication" class="mb-3" action="" method="POST" {{ route('password.email') }}>
                            @csrf
                            <div class="mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    placeholder="Email"
                                    name="email"
                                    :value="__('Email')"
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Reset password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
</x-guest-layout>
