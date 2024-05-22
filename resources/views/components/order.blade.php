@props([
    'order',
])

<div class="order">
    <div class="order__header">
            <span class="order-title">
                Order ID: {{ $order->order_id }}
                <span class="order-state-{{$order->state}}">({{ $order->stateInfo->name }})</span>
            </span>
    </div>
    <div class="order__body">
        <div class="order-image">
            <img src="/car.png" class="border-1 border-dark car-image">
        </div>
        <div class="order-description">
            <span class="order-label">Date added: <span class="order-info">{{ $order->created_at }}</span></span>
            <span class="order-label">Make: <span class="order-info">{{ $order->makeInfo->name }}</span></span>
            <span class="order-label">Model: <span class="order-info">{{ $order->model }}</span></span>
            <span class="order-label">Max Miles: <span class="order-info">{{ $order->max_miles }}</span></span>
            <span class="order-label">Desired Max Bid: <span class="order-info">${{ $order->max_bid }}</span></span>
            <span class="order-label">Damage Level: <span class="order-info">{{ $order->damageLevelInfo->name }}</span></span>
        </div>
    </div>
    <div class="order__notes">
        <span><b>Notes:</b> Minor damages only. I don’t want too much repairs. Prefer if it is near New York.</span>
    </div>
</div>

<style>
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
