@extends('layouts.admin-layout')

@section('content')
    <div class="container w-full mx-auto shadow-md sm:rounded-lg">
        @if(isset($users) && count($users) > 0)
            <div class="overflow-x-auto">
                <table class="w-full bg-gray-300 border border-brown-500 rounded-lg overflow-hidden">
                    <thead class="bg-brown-300 text-brown-700">
                        <tr>
                            @foreach(['Organization Name', 'Description', 'Email',  'Action'] as $header)
                                <th class="py-2 px-4 border-b sm:table-cell text-left">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="usersTableBody">
                        @foreach($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-b sm:table-cell">{{ $user['orgName'] }}</td>
                                <td class="py-2 px-4 border-b sm:table-cell">{{ $user['description'] }}</td>
                                <td class="py-2 px-4 border-b sm:table-cell">{{ $user['email'] }}</td>
                                <td class="py-2 px-4 border-b sm:table-cell">
                                    <div class="flex gap-2"> 
                                        {{-- <button type="button" class="bg-green-500 text-white px-2 py-1 rounded-md sm:mb-2" data-toggle="modal" data-target="#myModal">
                                            Show
                                        </button> --}}
                                        <button class="bg-green-500 text-white px-2 py-1 rounded-md sm:mb-2" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                            data-attr="{{$user['id']}}" title="Show">Show</a>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h1 class="font-bold text-2xl">User Requests</h1>
            <p class="m-3 p-4 bg-gray-300">No organization request found.</p>
        @endif
    </div>
@endsection

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document"  style="margin-top: 15%;">
    <div class="modal-content">
        <div class="modal-header">
            Confirmation
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="mediumBody">
             <!-- INSERT IMAGE HERE -->
            <img src="" alt="" id="verificationImage">
            
            <div>
            <form id="acceptForm" style="float:left"  method="POST" action="{{ url('/api/users/') }}/accept">
                    @csrf
                    {{method_field("PUT")}}
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded-md sm:mb-2">Accept</button>
                </form>
                <form id="rejectForm" style="float:left"  method="POST" action="{{ url('/api/users/') }}/reject">
                    @csrf
                    {{method_field("PUT")}}
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md sm:mb-2">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
<script>
$(document).on('click', '#mediumButton', function(event) {
    event.preventDefault();
    let userId = $(this).attr('data-attr');
    $.ajax({
        beforeSend: function() {
            $('#loader').show();
        },
        url: 'api/users/verification/' + userId,
        method: 'GET',
        dataType: 'json',
        // return the result
        success: function(result) {
            $('#verificationImage').attr('src', result.image);
            $('#acceptForm').attr('action', '/api/users/' + userId + '/accept');
            $('#rejectForm').attr('action', '/api/users/' + userId + '/reject');
            $('#mediumModal').modal("show");
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