@extends('layouts.master')

<link href="{{ asset('css/reserve.css') }}" rel="stylesheet" type="text/css">

@section('title', 'Payment')

@section('content')
  <div class="container mx-auto" style="padding: 10px; margin: 10px">
    <h3>Payment</h3>

    @if(!empty($success))
      <div class="alert alert-success"> {{ $success }}</div>
    @endif
    
    <a href="{{ route('home') }}">Return to Home</a>
  </div>
@endsection