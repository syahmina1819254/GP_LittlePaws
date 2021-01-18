@extends('layouts.admin');

@section('title', 'Edit Room Details');

@section('content')
  <div class="container mx-auto" style="padding: 10px; margin: 10px">
    @if ($errors->any())
      <div class="alert-alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
      <br>
    @endif
    <form method="post" action="{{ route('admin.hotel.update', $hotel->hotelID) }}">
        @csrf
        @method('PATCH')
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Room Type</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="hotelType" value="{{ $hotel->hotelType }}">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Max Pet Quantity (up to 10)</span>
          </div>
          <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="maxPetQty" value="{{ $hotel->maxPetQty }}">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Room Price</span>
          </div>
          <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="hotelPrice" step="0.01" min="0" value="{{ $hotel->hotelPrice }}">
        </div>
        <button type="submit" class="btn btn-secondary">Submit Changes</button>
    </form>
  </div>
@endsection