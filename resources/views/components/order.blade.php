@props([
'order',
])

<div class="order">
    <div class="order__header">
            <span class="order-title">
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                    <a href="{{ route('orders.edit', $order->id) }}">
                Order ID: {{ $order->order_id }}
                        <span class="order-state-{{$order->state}}">({{ $order->stateInfo->name }})</span>
                    </a>
                @else
                <div style="color: #696cff; font-family: Calibri;">
                Order ID: {{ $order->order_id }}
                        <span class="order-state-{{$order->state}}">({{ $order->stateInfo->name }})</span>
                </div>
               @endif
            </span>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-4 col-lg-3">
            <div style="height: 100%;">
                <div class="order-image">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach($order->photos as $photo)
                                <div class="swiper-slide">
                                    <img src="{{ $photo->path }}" alt="">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="order-description mt-2">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                        <span class="order-label mb-1">Client: <a href="{{ route('orders.index') . '?user=' . $order->user_id }}" class="order-info">{{ $order->client->name }} {{ $order->client->middle_name }} {{ $order->client->last_name }}</a></span>
                    @endif
                    <span class="order-label mb-1">Client ID: <span
                                class="order-info">{{ $order->user_id }}</span></span>
                    <span class="order-label mb-1">Date added: <span class="order-info">{{ \Carbon\Carbon::parse($order->created_at)->format('m/d/Y h:i A') }}</span></span>
                    <span class="order-label mb-1">Make: <span
                            class="order-info">{{ $order->makeInfo->name }}</span></span>
                    <span class="order-label mb-1">Model: <span class="order-info">{{ $order->model }}</span></span>
                    <span class="order-label mb-1">Years: <span class="order-info">{{ $order->years }}</span></span>
                    <span class="order-label mb-1">Max Miles: <span
                            class="order-info">{{ $order->max_miles }}</span></span>
                    <span class="order-label mb-1">Desired Max Bid: <span
                            class="order-info">${{ $order->max_bid }}</span></span>
                    <span class="order-label">Damage Level: <span
                            class="order-info">{{ $order->damageLevelInfo->name }}</span></span>
            </div>
        </div>
    </div>
    @if(strlen($order->notes) > 0)
        <div class="order__notes">
            <span><b>Notes:</b> {{ $order->notes }}</span>
        </div>
    @endif
</div>

<style>
    .car-image {
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }
    .flex-center {
        height: 100%;
        display: flex;
        justify-content: left;
        align-items: center;
    }

    .orders {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .order {
        display: flex;
        flex-direction: column;
        gap: 8px;
        background-color: #ffffff;
        padding: 20px;
        border-top: 1px solid #C9C9C9;
    }

    .order:first-child {
        border-top: none;
    }

    .order__body {
        display: flex;
        gap: 8px;
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

    .order-title {
        font-family: Inter;
        font-size: 26px !important;
        font-weight: 700;
        line-height: 32px;
        color: #000000;
    }

    .order-state-1 {
        color: #DEA000;
        font-width: 400;
    }

    .order-state-2 {
        color: #048540;
        font-width: 400;
    }

    .order-state-3 {
        color: #D13333;
        font-width: 400;
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
</style>
