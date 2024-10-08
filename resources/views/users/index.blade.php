<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 card pt-2 pb-2">
                <h3>
                    Users
                    <sup class="badge badge-notifications bg-info p-1" style="top: -16px">
                        {{$users->count()}}
                    </sup>
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>ClientID</th>
                        <th>Orders</th>
                        <th>Purchases</th>
                        <th>Account type</th>
                        <th>Bussiness name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Manager</th>
                        <th></th>
                    </tr>
                @foreach($users as $user)
                    <tr>
                        <td> {{ $user->id }}</td>
                        <td> {{ $user->client_id }}</td>
                        <td><a href="{{ route('orders.index') . '?user='.$user->id }}" class="btn btn-sm btn-primary">Orders</a></td>
                        <td><a href="{{ route('purchases.index') . '?user='.$user->id }}" class="btn btn-sm btn-primary">Purchases</a></td>
                        <td> {{ $user->accountType->name }}</td>
                        <td> {{ $user->name }}</td>
                        <td> {{ $user->getName() }}</td>
                        <td> {{ $user->email }}</td>
                        <td> {{ $user->countryInfo->name }}</td>
                        <td> {{ $user->managerInfo->getName() }}</td>
                        <td><a href="{{ route('users.edit', $user->id) }}">Edit</a></td>
                    </tr>
                @endforeach
                </table>
                </div>
                <div class="mt-3">
                    <x-pagination :pagesCount="$pagesCount" :curPage="$curPage"  :link="route('users.index')" :showCount="5" />
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
</style>
