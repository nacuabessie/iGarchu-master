@extends('layouts.layout')

@section('content')
<div class="flex justify-center items-center h-screen ">  
  <div class="w-full h-screen flex">
    <div class="w-[40%]">
      <div class="flex flex-col w-full items-center justify-center">
        <div class="flex justify-center flex-col items-center">
          <img src="{{ asset('image/doglogo.png') }}" alt="Example Image">
          <h1 class="font-bold text-amber-700 text-4xl ">iGarchu</h1>
        </div>
  
        <form class="m-28 flex flex-col w-[80%]  gap-10" action="/api/login" method="POST">
          @csrf
          <h1 class="font-bold text-center text-gray-700">
            Sign In To Continue
          </h1>
          <div class="w-full flex flex-col  gap-2">
            <input type="text" id="username" name="username" class="rounded-md border border-amber-800 p-3 " placeholder="Email" required
            />
            <input type="password" id="password" name="password"  class="rounded-md border border-amber-800 text-white p-3 "  placeholder="Password" required
            />
  

            <div class="flex items-center justify-between">
              <button type="submit" class="bg-amber-800 text-white px-4 py-2 rounded hover:bg-amber-600 focus:outline-none w-full">Login</button>
            </div>
            
          </div>
        </form>
      </div>
    </div>
    <div class="w-[60%] bg-amber-900 flex justify-center items-center">
      <img src="{{ asset('image/dog.png') }}" alt="dog">
    </div>
    @if (isset($message))
    <div id="notification" class="fixed top-4 right-4 bg-red-500 text-white p-4 rounded shadow-lg ">
      {{$message}}
    </div>
    @endif
  </div>
@endsection



