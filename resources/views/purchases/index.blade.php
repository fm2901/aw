<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 card">
                @can('create purchases')
                    <a class="add-btn" href="{{ route('purchases.create') }}">+</a>
                @endcan
                <div class="row">
                    <div class="dropdown col-md-5 col-sm-5 w-50">
                        <a class="btn dropdown-toggle font-black" style="color: black; font-size: 1.3em" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Purchases
                            <sup class="badge badge-notifications bg-info p-1" style="top: -16px">
                                {{$purchases->count()}}
                            </sup>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('orders.index') }}">Orders</a>
                        </div>
                    </div>
                    {!! \App\Helpers\Helper::printPurchasesMenu($currentSort) !!}
                </div>
                @foreach($purchases as $purchase)
                   <x-purchase :purchase="$purchase"/>
                @endforeach
                @if($pagesCount > 1)
                    <x-pagination :pagesCount="$pagesCount" :curPage="$curPage"  :query="$query" :link="route('purchases.index')" :showCount="5" />
                @endif
                @if($purchases->count() < 1)
                    <div class="mt-3 mb-3 text-center">
                        You have no purchases
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .badge {
        font-size: 0.5em;
        top: -1em
    }
</style>
