@props([
'purchase',
])

<div class="order">

    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-4 col-lg-2">
            <div style="height: 100%">
                <div class="order-image">
                        @if(count($purchase->photos) < 1)
                            <img src="/assets/img/car.png">
                        @endif
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($purchase->photos as $photo)
                                    <div class="swiper-slide">
                                        <img src="{{ $photo->path }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                            <a href="{{ route('purchases.edit', [$purchase->id]) }}">Edit</a>
                        @endif
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-10">
            <div class="order-description mt-2">
                <a href="{{ route('purchases.show', [$purchase->id]) }}" class="btn-link">
                    <span
                        class="order-label mb-1">{{ $purchase->year }} {{ $purchase->makeInfo->name }} {{ $purchase->model }} {{ $purchase->trim }}</span>
                </a>
                @if(auth()->user()->id != $purchase->clientInfo->id)
                    <span class="order-label mb-1">Client ID: <a href="{{ route('purchases.index') . '?user=' . $purchase->user_id }}" class="order-info">{{ $purchase->clientInfo->client_id }}</a></span>
                @endif
                <span class="order-label mb-1">VIN: <span class="order-info">{{ $purchase->vin }}</span></span>
                <span class="order-label mb-1">Purchase ID: <span
                        class="order-info">{{ $purchase->purchase_id }}</span></span>
                <span class="order-label mb-1">Award Date: <span class="order-info">{{ \Carbon\Carbon::parse($purchase->award_date)->format('m/d/Y') }}</span></span>
                <span class="order-label mb-1">Outstanding Balance: <span
                        class="order-info balance-<?=$purchase->balance > 0 ? 1 : 0;?>">${{ number_format($purchase->balance, 2) }}</span></span>
            </div>
        </div>
    </div>
</div>

<style>
    .swiper-slide {
        width: 100%;
        height: auto;
    }
    .car-image {
        border-radius: 10px;
        border: solid 3px black;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

    .order-image img {
        width: 100%;
        height: auto;
    }

    .order {
        display: flex;
        flex-direction: column;
        background-color: #ffffff;
        padding: 20px;
        border-top: 1px solid #C9C9C9;
    }

    .order:first-child {
        border-top: none;
    }

    .order-description {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    .order-image img {
        width: 100%;
        height: auto;
    }

    .order-label {
        font-size: 18px;
        font-weight: 700;
        line-height: 22px;
        color: #504545;
        margin: 0;
    }

    .order-info {
        font-size: 18px;
        font-weight: 400;
        line-height: 21px;
        color: #504545;
    }
    .balance-1 {
        color: red;
    }
</style>
