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

 

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 "  id="userGrid">
        @foreach($users as $user)
            <div class="h-[55vh] border rounded-lg bg-[#ECA766] border-gray-700 shadow-md sm:rounded-lg" data-role="{{ $user['role'] }}">
                @if($user['role'] == 2 && ($user['verificationStatus'] == 'SUCCESSFUL' || $user['verificationStatus'] == 'successful'))
                    <button class=" absolute mt-3 ml-2 bg-[#D63930] text-white px-2 py-1 rounded-md sm:mb-2" data-toggle="modal" id="verificationButton" data-target="#mediumModal" data-attr="{{$user['id']}}" title="Show">
                        Show
                    </button>
                @endif
                <img class="rounded-t-lg h-3/6 object-fill w-full" src={{$user['cover']}} alt="cover" />
                <div class="px-4 py-2 ">                                         
                    {{-- Role 2 (Organization) --}}
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <img class="rounded-full w-12 h-12" src={{$user['profile']}} alt="organization">
                                <div>
                                    <h5 class="mt-2 text-lg font-bold tracking-tight text-amber-950">@if($user['role'] == 2){{ $user['orgName'] }} @else {{ $user['firstName'] }} {{ $user['lastName'] }}@endif</h5>
                                    <h5 class=" mt-2 mb-1 font-bold text-sm text-amber-950 tracking-tight">INFORMATION</h4>
                                    <h5 class="text-sm text-amber-900 tracking-tight">{{ $user['email'] }}</h5>
                                    <h5 class="text-sm text-amber-900 tracking-tight">{{ $user['contactNo'] }}</h5>
                                    <h5 class="text-sm text-amber-900 tracking-tight">{{ $user['locationDetails']['address'] }}</h5>
                                    
                                </div>
                            </div>
                            <div class="">
                                <h5 class="text-sm tracking-tight max-w-fit  border py-1 px-2 rounded
                                    @if($user['role'] == 2) font-medium text-white bg-[#5A352C] @else font-bold text-[#5A352C] bg-[#FEE9D6] @endif
                                ">
                                    @if($user['role'] == 2 && ($user['verificationStatus'] == 'successful' || $user['verificationStatus'] == 'SUCCESSFUL'))Organization @elseif($user['verificationStatus'] == 'PENDING')Applicant @else Adopter @endif
                                </h5>
                            </div>
                        </div>
                        <!-- <div class="mt-4 text-gray-400">
                            <p class="truncate">{{ $user['description'] }}</p>
                        </div>  -->
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
    
    $(document).on('click', '#verificationButton', function(event) {
        event.preventDefault();
        let userId = $(this).attr('data-attr');
        $.ajax({
            beforeSend: function() {
                $('#loader').show();
            },
            url: 'api/users/verification/accepted/' + userId,
            method: 'GET',
            dataType: 'json',
            // return the result
            success: function(result) {
                $('#verificationImage').attr('src', result.image);
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });
</script>
@endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document"  style="margin-top: 15%;">
    <div class="modal-content">
        <div class="modal-header">
            ACCEPTED VERIFICATION
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="mediumBody">
             <!-- INSERT IMAGE HERE -->
            <img src="" alt="" id="verificationImage">
        </div>
    </div>
</div>
</div>
