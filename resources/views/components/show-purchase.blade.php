@props([
    'purchase',
])

<div class="purchase-show">
   <div class="purchase__header">
       <a class="purchase-title" href="{{ route('purchases.index') }}">
           <img src="/arrow-back.svg" alt="">
           Purchase {{ $purchase->purchase_id }}</a>
   </div>
    <div class="purchase__body">
        <div class="purchase__thumb">
            @if(empty($purchase->photo))
                <img src="/cars/car.png" class="border-1 border-dark car-image">
            @else
                <img src="{{ $purchase->photo }}" class="border-1 border-dark car-image">
            @endif   
       </div>
        <div class="purchase__info">
            <span class="purchase-title">{{ $purchase->year }} {{ $purchase->makeInfo->name }} {{ $purchase->model }} {{ $purchase->trim }}</span>
            <span class="purchase-label">VIN: <span class="purchase-info">{{ $purchase->vin }}</span></span>
            <span class="purchase-label">Year: <span class="purchase-info">{{ $purchase->year }}</span></span>
            <span class="purchase-label">Make: <span class="purchase-info">{{ $purchase->makeInfo->name }}</span></span>
            <span class="purchase-label">Model: <span class="purchase-info">{{ $purchase->model }}</span></span>
            <span class="purchase-label">Trim: <span class="purchase-info">{{ $purchase->trim }}</span></span>
        </div>
    </div>
</div>


<style>

    .purchase-show {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 1rem;
    }

    .purchase__body {

    }

    .purchase__info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .purchase__thumb img {
        width: 80%;
    }

    .purchase-title {
        font-family: Inter;
        font-size: 26px !important;
        font-weight: 700;
        line-height: 32px;
        color: #000000;
    }

    .purchase-title:hover {
        color: #000000;
    }

    .purchase-label {
        font-size: 18px;
        font-weight: 700;
        line-height: 22px;
        color: #504545;
        margin: 0;
    }

    .purchase-info {
        font-size: 18px;
        font-weight: 400;
        line-height: 21px;
        color: #504545;
        margin-top: 3rem;
    }

</style>
