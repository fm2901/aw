<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 card">
                <h2 class="card-header">Purchases</h2>
                @foreach($purchases as $purchase)
                   <x-purchase :purchase="$purchase"/>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
