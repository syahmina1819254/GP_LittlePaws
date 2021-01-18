@extends('layouts.master')

@section('title', 'Homepage')

@section('content')
<div class="container mx-auto" style="padding: 10px; margin: 10px">
    
    @if (Route::has('login'))
        <div class="card mx-auto text-left" style="width: 50rem">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    
    <div class="card mx-auto text-left" style="width: 50rem">
        <h5 class="card-header">Welcome!</h5>
        <p class="card-text" style="padding: 5px; margin-left: 15px">Welcome to LittlePaws! Navigate using the navbar to get started with your adventure!</p>
        <br>
        <p class="card-text" style="padding: 5px; margin-left: 15px""><b>What can you do?</b></p>
        <ul>
            <li><b>Reserve a room: </b>You can reserve a room for your pets and pay for them here!</li>
            <li><b>Adopt a pet: </b>Fancy adopting a pet? Request for one right now and check for the request status, all in one app!</li>
        </ul>
        
    </div>
</div>
@endsection