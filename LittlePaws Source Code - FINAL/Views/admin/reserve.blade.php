@extends('layouts.admin')

@section('title', 'Reservations')

@if(session()->get('success'))
    <div class="alert alert-success text-center">
      {{ session()->get('success') }}  
    </div>
@endif

@section('content')
<div class="container mx-auto" style="padding: 10px; margin: 50px">
  <br/>
  <h3>Reservation List</h3>    
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr>
            <th scope="col" class="text-center">Book ID</th>
            <th scope="col" class="text-center">User ID</th>
            <th scope="col" class="text-center">User Name</th>
            <th scope="col" class="text-center">Room ID</th>
            <th scope="col" class="text-center">Room Type</th>
            <th scope="col" class="text-center">Pet Quantity</th>
            <th scope="col" class="text-center">Check In Date</th>
            <th scope="col" class="text-center">Check Out Date</th>
            <th scope="col" class="text-center">Payment Method</th>
            <th scope="col" class="text-center">Payment Amount</th>
            <th scope="col" class="text-center">Payment Made At</th>
            <th scope="col" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          @foreach($bookings as $key => $data)
          <tr>
              <th scope="row" class="text-center">{{$data->bookID}}</th>
              <td class="text-center">{{$data->userID}}</td>
              <td class="text-center">{{$data->name}}</td>
              <td class="text-center">{{$data->hotelID}}</td>
              <td class="text-center">{{$data->hotelType}}</td>
              <td class="text-center">{{$data->petQty}}</td>
              <td class="text-center">{{$data->checkInDate}}</td>
              <td class="text-center">{{$data->checkOutDate}}</td>
              <td class="text-center">{{$data->payMethod}}</td>
              <td class="text-center">{{$data->payAmt}}</td>
              <td class="text-center">{{$data->created_at}}</td>
              <td class="text-center">
                  <form action="{{ route('admin.reserve.destroy', $data->hotelID)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
<div>
@endsection