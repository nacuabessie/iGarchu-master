@extends('layouts.admin-layout')

@section('content')
    <div class="container mx-auto w-full pr-4">
        <div class="mb-4">
            <div class="flex items-center justify-between">
                <h2>Donations</h2>
                <div>
                    <label for="isActiveFilter" class="text-sm text-gray-500">WATATAPS:</label>
                    <select id="isActiveFilter" name="isActiveFilter" class="ml-2 border p-1 rounded-md" onchange="filterTable()">
                        <option value="all">All</option>
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
