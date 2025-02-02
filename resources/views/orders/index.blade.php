<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 card">
                <a class="add-btn" href="{{ route('orders.create') }}">+</a>
                <div class="row">
{{--                    <div class="dropdown menu-dropdown col-md-6 col-sm-6 w-50">--}}
{{--                        <a class="btn dropdown-toggle font-black" style="color: black; font-size: 1.3em" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            Orders--}}
{{--                            <sup class="badge badge-notifications bg-info p-1" style="top: -16px">--}}
{{--                                {{ $allCount }}--}}
{{--                            </sup>--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
{{--                            <a class="dropdown-item" href="{{ route('purchases.index') }}">Purchases</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    {!!\App\Helpers\Helper::printOrdersSortMenu(request()->query())!!}
                    {!!\App\Helpers\Helper::printOrdersMenu(request()->query())!!}
                </div>
                <div class="row">
                    @foreach($orders as $order)
                        <x-order :order="$order"/>
                    @endforeach
                </div>
                @if($pagesCount > 1)
                    <x-pagination :pagesCount="$pagesCount" :curPage="$curPage"  :query="$query" :link="route('orders.index')" :showCount="5" />
                @endif
                @if($orders->count() < 1)
                    <div class="mt-3 mb-3 text-center">
                        You have no orders
                    </div>
                @endif
                <div class="row mt-4 mb-1">
                    <div class="col">
                        <h6 class="text-bold text-gray-600 text-center">To edit or delete an order, please contact your account manager.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    h5 {
        display: inline;
    }

    .badge {
        font-size: 0.5em;
        top: -1em
    }
    .order-filter {
        color: black;
        font-size: 1.3em
    }
    @media screen and (max-width: 400px) {
        .order-menu-item {
            font-size: 0.7em;
        }
        .order-filter {
            font-size: 1em
        }
    }
</style>
