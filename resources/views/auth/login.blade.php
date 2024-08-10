<x-guest-layout>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
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
                        <h4 class="mb-2 text-black fs-3 text-center mt-5">Sign in to Your Account</h4>

                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form id="formAuthentication" class="mb-3" action="" method="POST" {{ route('login') }}>
                            @csrf
                            <div class="mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    placeholder="Email"
                                    name="email"
                                    :value="old('email')" required autofocus
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input
                                        id="password"
                                        class="form-control"
                                        placeholder="Password"
                                        aria-describedby="password"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-show"></i></span>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                                </div>
                                <div style="text-align: right">
                                    <a href="{{ route('password.email') }}">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Don't have an account with us?</span>
                            <a href="{{ route('register')}}">
                                <span>Sign Up</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
</x-guest-layout>
