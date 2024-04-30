@extends('layouts.admin-layout')

@section('content')
    <div class="container w-full mx-auto shadow-md sm:rounded-lg">
        @if(isset($users) && count($users) > 0)
            <div class="overflow-x-auto">
                <table class="w-full bg-white border border-brown-500 rounded-lg overflow-hidden">
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
                                        <form method="POST" action="{{ url('/api/users/' . $user['id'] . '/accept') }}">
                                            @csrf
                                            {{method_field("PUT")}}
                                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded-md sm:mb-2">Accept</button>
                                        </form>
                                        <form method="POST" action="{{ url('/api/users/' . $user['id'] . '/reject') }}">
                                            @csrf
                                            {{method_field("PUT")}}
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md sm:mb-2">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="p-4">No organization request found.</p>
        @endif
    </div>
@endsection