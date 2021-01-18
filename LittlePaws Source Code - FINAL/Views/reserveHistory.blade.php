@extends('layouts.master')

@section('title', 'Reservation History')

@section('content')
<div class="container mx-auto" style="padding: 10px; margin: 10px">
  <br/>
  <h3>Reservation History</h3>    
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr>
            <th scope="col" class="text-center">Room Number</th>
            <th scope="col" class="text-center">Room Type</th>
            <th scope="col" class="text-center">Pet Quantity</th>
            <th scope="col" class="text-center">Check In Date</th>
            <th scope="col" class="text-center">Check Out Date</th>
            <th scope="col" class="text-center">Payment Method</th>
            <th scope="col" class="text-center">Payment Amount</th>
            <th scope="col" class="text-center">Payment Made At</th>
          </tr>
      </thead>
      <tbody>
          @foreach($reserve as $key => $data)
          <tr>
              <th scope="row" class="text-center">{{$data->hotelID}}</th>
              <td class="text-center">{{$data->hotelType}}</td>
              <td class="text-center">{{$data->petQty}}</td>
              <td class="text-center">{{$data->checkInDate}}</td>
              <td class="text-center">{{$data->checkOutDate}}</td>
              <td class="text-center">{{$data->payMethod}}</td>
              <td class="text-center">{{$data->payAmt}}</td>
              <td class="text-center">{{$data->created_at}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
<div>
@endsection