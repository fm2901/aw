<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 card pt-2 pb-2">
                <a class="add-btn" href="{{ route('orders.create') }}">+</a>
                <h3>
                    Users
                    <sup class="badge badge-notifications bg-info p-1" style="top: -16px">
                        {{$users->count()}}
                    </sup>
                </h3>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>ClientID</th>
                        <th>Account type</th>
                        <th>Bussiness name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Manager</th>
                        <th>Buy power</th>
                        <th></th>
                    </tr>
                @foreach($users as $user)
                    <tr>
                        <td> {{ $user->id }}</td>
                        <td> {{ $user->client_id }}</td>
                        <td> {{ $user->accountType->name }}</td>
                        <td> {{ $user->name }}</td>
                        <td> {{ $user->getName() }}</td>
                        <td> {{ $user->email }}</td>
                        <td> {{ $user->countryInfo->name }}</td>
                        <td> {{ $user->managerInfo->getName() }}</td>
                        <td> {{ $user->buy_power }}</td>
                        <td><a href="{{ route('users.edit', $user->id) }}">Edit</a></td>
                    </tr>
                @endforeach
                </table>
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
