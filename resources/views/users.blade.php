@extends('layouts.admin-layout')

@section('content')
<div class="container w-full mx-auto pr-4">
    <div class="flex justify-between items-center mb-5 w-full">
        <h1 class="font-bold text-2xl">Users</h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-500">Filter by Role:</span>
            <select id="roleFilter" class="form-select border rounded border-gray-400 px-2 py-1">
                <option value="" selected>All</option>
                <option value="1">Adopter</option>
                <option value="2">Organization</option>
            </select>
        </div>
    </div>

 

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 "  id="userGrid">
        @foreach($users as $user)
            <div class="h-[30vh] border rounded-lg bg-gray-800 border-gray-700 shadow-md sm:rounded-lg" data-role="{{ $user['role'] }}">
                <img class="rounded-t-lg h-3/5 object-fill w-full" src={{$user['cover']}} alt="cover" />
                <div class="px-4 py-2 "> 
                    
                    
                    {{-- Role 2 (Organization) --}}
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <img class="rounded-full w-12 h-12" src={{$user['profile']}} alt="organization">
                                <div>
                                    <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">@if($user['role'] == 2){{ $user['orgName'] }} @else {{ $user['firstName'] }} {{ $user['lastName'] }}@endif</h5>
                                    <h5 class="text-sm text-gray-400 tracking-tight">{{ $user['email'] }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <h5 class="text-sm tracking-tight max-w-fit  border py-1 px-2 rounded
                                    @if($user['role'] == 2) text-green-600 border-green-600 @else text-gray-400 border-gray-500 @endif
                                ">
                                    @if($user['role'] == 2)Organization @else Adopter @endif
                                </h5>
                            </div>
                        </div>
                        <div class="mt-4 text-gray-400">
                            <p class="truncate">{{ $user['description'] }}</p>
                        </div>
                    
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.getElementById('roleFilter').addEventListener('change', function () {
        const selectedRole = this.value;
        const userCards = document.querySelectorAll('#userGrid .border');

        userCards.forEach(card => {
            const cardRole = card.getAttribute('data-role');
            if (!selectedRole || selectedRole === cardRole) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endsection