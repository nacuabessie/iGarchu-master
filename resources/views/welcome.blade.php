@extends('layouts.layout')

@section('content')
<h1 class="">User Data:</h1>
<pre>{{ json_encode($users, JSON_PRETTY_PRINT) }}</pre>
@endsection