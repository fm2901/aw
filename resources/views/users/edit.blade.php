<x-app-layout>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <a class="purchase-title" href="{{ route('users.index') }}">
                                <img src="/arrow-back.svg" alt="">
                            </a>
                            <h3 class="text-black text-center d-inline">Edit {{ $user->accountType->name }} Account</h3>
                        </div>
                        @if(is_null($type) || is_null(\App\Models\AccountType::find($type)))
                            <div class="mb-3">
                                @foreach($accountTypes as $at)
                                    <a href="{{ route('register') }}/{{ $at->id }}" style="font-size: 1.7em;" class="btn btn-primary d-block p-1 mb-3"> {{ $at->name }}</a>
                                @endforeach
                            </div>
                        @else
                            <form id="formAuthentication" class="mb-3" enctype="multipart/form-data" method="POST" action="{{ route('users.update',['id' => $user->id]) }}">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Role</label>
                                    <select name="role" class="form-control" required>
                                        {{!!\App\Helpers\Helper::getOptions(\App\Models\Role::all(), $user->hasRole('admin') ? 1 : 2)!!}}
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                                </div>
                                <div class="mb-3">
                                    <label for="manager" class="form-label">Manager</label>
                                    <select name="manager" class="form-control" required >
                                        @foreach($managers as $c)
                                            <option value="{{ $c->id }}" @php if($user->manager == $c->id) echo "selected" @endphp>{{ $c->first_name }} {{ $c->last_name }} {{ $c->middle_name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>
                                @if($type == 1)
                                    <x-business :errors="$errors" :countries="$countries" :vehicleTo="$vehicleTo" :user="$user"/>
                                @endif
                                @if($type == 2)
                                    <x-person :errors="$errors" :countries="$countries" :user="$user"/>
                                @endif
                                <x-purchase-needs :errors="$errors" :purchasePurposes="$purchasePurposes" :carStates="$carStates" :toExport="$toExport" :priceRanges="$priceRanges" :experiensePeriods="$experiensePeriods" :user="$user"/>

                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Deposit required</label>
                                        <input type="text" class="form-control" required  id="last_name" name="deposit_min" value="{{ $user?->deposit_min }}" placeholder="Enter deposit required"/>
                                        <x-input-error :messages="$errors->get('deposit_min')" class="mt-2" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Deposit on fire</label>
                                        <input type="text" class="form-control" required  id="deposit" name="deposit" value="{{ $user?->deposit }}" placeholder="Enter deposit on fire"/>
                                        <x-input-error :messages="$errors->get('deposit')" class="mt-2" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Buy power</label>
                                        <input type="text" class="form-control" required  id="buy_power" name="buy_power" value="{{ $user?->buy_power }}" placeholder="Enter buy power"/>
                                        <x-input-error :messages="$errors->get('buy_power')" class="mt-2" />
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <h3>Documents</h3>
                                    @foreach($user->files as $i => $file)
                                        <div id="doc-{{$file->id}}" class="d-flex">
                                            <button class="btn btn-sm btn-danger mr-3" onclick="deleteDoc({{ $file->id }})">Delete</button>
                                            <a download class="d-block ml-3" href="{{ $file->path }}">{{ ++$i }}. {{ substr($file->path,6) }}</a>
                                        </div>
                                    @endforeach
                                </div><div class="mb-3">
                                    <label for="files" class="form-label">Documents</label>
                                    <input type="file"  class="form-control" id="files" multiple name="files[]"/>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text"  class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter your email" autofocus/>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">New password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Confirm password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-md-4 float-end">
                                    <button class="btn btn-primary">Save</button>
                                    <a href="{{ route("users.index") }}" class="btn btn-secondary float-end d-block" style="margin-right: 10px">Cancel</a>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function deleteDoc(docId) {
        if (confirm('Do you want delete this doc?')) {
            $.ajax({
                url: '/photos/' + docId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('#doc-' + docId).remove(); // Удаляем слайд из DOM
                },
                error: function(xhr) {
                    alert('Doc deleting error');
                }
            });
        }
    }
</script>
