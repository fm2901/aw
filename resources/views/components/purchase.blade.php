@props([
    'purchase',
])

<div class="order">
    <div class="order__body">
        <div class="order-image">
            <a href="{{ route('purchases.show', [$purchase->id]) }}">
                @if(empty($purchase->photo))
                    <img src="/cars/car.png" class="border-1 border-dark car-image">
                @else
                    <img src="{{ $purchase->photo }}" class="border-1 border-dark car-image">
                @endif    
            </a>
        </div>
        <div class="order-description">
            <a href="{{ route('purchases.show', [$purchase->id]) }}">
                <span class="order-label">{{ $purchase->year }} {{ $purchase->makeInfo->name }} {{ $purchase->model }} {{ $purchase->trim }}</span>
            </a>
            <span class="order-label">VIN: <span class="order-info">{{ $purchase->vin }}</span></span>
            <span class="order-label">Purchase ID: <span class="order-info">{{ $purchase->purchase_id }}</span></span>
            <span class="order-label">Award Date: <span class="order-info">{{ $purchase->award_date }}</span></span>
            <span class="order-label">Outstanding Balance: <span class="order-info balace-<?=$purchase->balance > 0 ? 1 : 0;?>">${{ number_format($purchase->balance, 2) }}</span></span>
        </div>
    </div>
</div>

<style>
    .balace-0 {
        color: #D33535 !important;
    }

    .balace-1 {
        color: #13A355 !important;
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

    .order__body {
        display: flex;
        gap: 8px;
    }

    .order-description {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .order-image img {
        width: 155px;
        height: 155px;
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
