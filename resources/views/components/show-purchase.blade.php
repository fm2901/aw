@props([
    'purchase',
    'invoice',
])

<div class="purchase-show">
   <div class="purchase__header">
       <a class="purchase-title" href="{{ route('purchases.index') }}">
           <img src="/arrow-back.svg" alt="">
           Purchase {{ $purchase->purchase_id }}</a>
           <div class="row mb-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s" style="position: relative; visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
               @if($purchase->photos)
                   <div class="swiper">
                       <div class="swiper-wrapper">
                           @foreach($purchase->photos as $photo)
                               <div class="swiper-slide" id="slide-{{$photo->id}}">
                                   <a href="image4_large.jpg" data-lightbox="gallery">
                                       <img src="{{ $photo->path }}" style="width: 100%" alt="Image 4">
                                   </a>
                                   <button type="button" class="delete-button btn btn-sm btn-danger" onclick="confirmDelete({{ $photo->id }})">Delete</button>
                               </div>
                           @endforeach
                       </div>
                       <!-- Навигация -->
                       <div class="swiper-button-next"></div>
                       <div class="swiper-button-prev"></div>
                       <!-- Ползунок -->
                       <div class="swiper-pagination"></div>
                   </div>
               @else
                   <div class="col-md-3 col-sm-6 portfolio-item first" style="position: absolute; left: 0px; top: 0px;">
                       <div class="portfolio-img rounded overflow-hidden">
                           <img class="img-fluid purchase-image" src="/cars/car.png" alt="">
                           <div class="portfolio-btn">
                               <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{ $photo->path }}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                               <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href=""><i class="fa fa-link"></i></a>
                           </div>
                       </div>
                   </div>
               @endif
           </div>
   </div>

    <div class="purchase__body">
        <div class="purchase__info">
            <span class="purchase-title">{{ $purchase->year }} {{ $purchase->makeInfo->name }} {{ $purchase->model }} {{ $purchase->trim }}</span>
            <span class="purchase-label">VIN: <span class="purchase-info">{{ $purchase->vin }}</span></span>
            <span class="purchase-label">Year: <span class="purchase-info">{{ $purchase->year }}</span></span>
            <span class="purchase-label">Make: <span class="purchase-info">{{ $purchase->makeInfo->name }}</span></span>
            <span class="purchase-label">Model: <span class="purchase-info">{{ $purchase->model }}</span></span>
            <span class="purchase-label">Trim: <span class="purchase-info">{{ $purchase->trim }}</span></span>
            <hr class="mb-3 mt-3">
            <span class="purchase-label">Award Date: <span class="purchase-info">{{ \Carbon\Carbon::parse($purchase->award_date)->format('m/d/Y') }}</span></span>
            <span class="purchase-label">Auction: <span class="purchase-info">{{ $purchase->auction }}</span></span>
            <span class="purchase-label">Auction location: <span class="purchase-info">{{ $purchase->auction_location }}</span></span>
            <span class="purchase-label">Lot Number: <span class="purchase-info">{{ $purchase->lot }}</span></span>
            <hr class="mb-3 mt-3">
            <span class="purchase-label">Outstanding balance: <span class="purchase-info">{{ $purchase->balance }}</span></span>
            <a class="file-link" href="{{ $purchase->invoice }}">
                <img class="file-icon" src="/assets/img/pdf.png" alt="">
                {{ $invoice }}
            </a>
            <hr class="mb-3 mt-3">
            <span class="purchase-label">Delivery Notes: </span>
            <span class="purchase-notes">{{ $purchase->notes }}</span>
            <hr class="mb-3 mt-3">
            <span class="purchase-label">Attachments: <span class="purchase-info">{{ $purchase->balance }}</span></span>
            <a class="file-link" href="{{ $purchase->invoice }}">
                <img class="file-icon" src="/assets/img/pdf.png" alt="">
                {{ $invoice }}
            </a>
        </div>
    </div>
</div>


<style>

    .purchase-image {
        width: 80px;
    }

    .file-icon {
        width: 40px;
    }

    .file-link {
        font-size: 12px;
        font-family: Calibri;
        color: #000000;
    }

    a.file-link:active {
        color: #000000;
    }

    .purchase-show {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 1rem;
    }

    .car-image {
        border-radius: 10px;
        border: solid 3px black;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        width: 50%;
        height: auto;
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
        font-family: Calibri;
        font-size: 22px !important;
        font-weight: 700;
        line-height: 32px;
        color: #000000;
    }

    .purchase-title:hover {
        color: #000000;
    }

    .purchase-label {
        font-size: 17px;
        font-weight: bold;
        line-height: 22px;
        color: #000000;
        margin: 0;
    }

    .purchase-info {
        font-size: 17px;
        font-weight: 400;
        line-height: 21px;
        color: #000000;
        margin-top: 3rem;
    }

</style>
