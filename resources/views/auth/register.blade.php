<x-guest-layout>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <a class="purchase-title" href="{{ route('login') }}">
                                <img src="/arrow-back.svg" alt="">
                            </a>
                            <a href="{{ route('orders.index')}}">
                                <img src="/logo.png" class="w-75" alt="">
                            </a>
                        </div>
                        <h3 class="text-black text-center mb-3">Create Account</h3>
                            @if(is_null($type) || is_null(\App\Models\AccountType::find($type)))
                                <div class="mb-3">
                                    @foreach($accountTypes as $at)
                                        <a href="{{ route('register') }}/{{ $at->id }}" style="font-size: 1.7em;" class="btn btn-primary d-block p-1 mb-3"> {{ $at->name }}</a>
                                    @endforeach
                                </div>
                            @else
                            <form id="formAuthentication" class="mb-3" action="" method="POST" {{ route('register') }}>
                                @csrf
                                @if($type == 1)
                                    <x-business :errors="$errors" :countries="$countries" :vehicleTo="$vehicleTo" :user="$user"/>
                                @endif
                                @if($type == 2)
                                        <x-person :errors="$errors" :countries="$countries" :user="$user"/>
                                @endif
                                <x-purchase-needs :errors="$errors" :purchasePurposes="$purchasePurposes" :carStates="$carStates" :toExport="$toExport" :priceRanges="$priceRanges" :experiensePeriods="$experiensePeriods" :user="$user"/>
                                <div class="mb-3">
                                    <h3>Agreement</h3>
                                    <p style="font-size: 14px;text-align: justify">Welcome to AuctionWarriors and thank you for starting your auction journey with us! Please click here to review our Agreement, Pricing, Rules and Policies (collectively, "Agreement"). By using any of our services, you and/or the company you are representing affirm that you accept and agree to this Agreement, you are at least 18 years old, and you have the ability to form legally binding contracts. Therefore, please review this Agreement carefully and retain a copy for your record. Without a notice to you, we may change this agreement at any time, and by continuing to use our Services, you agree to this Agreement as changed.</p>
                                </div>
                                <div class="mb-3">
                                    Review the <a href="{{ env('AGREEMENT_LINK') }}">Agreement</a> and agree to continue.
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text"  class="form-control" id="email" name="email" placeholder="Enter your email" autofocus/>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Confirm password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms-conditions" required name="terms" />
                                        <label class="form-check-label" for="terms-conditions">
                                            I agree to
                                            <a href="{{ env('AGREEMENT_LINK') }}">privacy policy & terms</a>
                                        </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary d-grid w-100">Sign up</button>
                            </form>
                            @endif
                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('login')}}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>


