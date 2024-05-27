<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 card">
                <h2 class="card-header">Orders</h2>
                @foreach($orders as $order)
                    <x-order :order="$order"/>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    h5  {
        display: inline;
    }
</style>
