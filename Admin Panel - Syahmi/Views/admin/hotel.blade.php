@extends('layouts.admin')

@section('title', 'Hotels')

@section('content')
  <div class="container mx-auto" style="padding: 10px; margin: 10px">
    <br/>
    <h3>Room List</h3>

    @if(session()->get('success'))
        <div class="alert alert-success text-center">
          {{ session()->get('success') }}  
        </div>
    @endif

    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Room Type</th>
            <th scope="col" class="text-center">Max Pet Quantity</th>
            <th scope="col" class="text-center">Price</th>
            <th scope="col" colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          @foreach($hotels as $key => $data)
          <tr>
              <th scope="row" class="text-center">{{$data->hotelID}}</th>
              <td class="text-center">{{$data->hotelType}}</td>
              <td class="text-center">{{$data->maxPetQty}}</td>
              <td class="text-center">{{$data->hotelPrice}}</td>
              <td class="text-center">
                  <form action="{{ route('admin.hotel.edit', $data->hotelID)}}" method="post">
                    @csrf
                    <button type="submit">Edit</button>
                  </form>
              </td>
              <td class="text-center">
                  <form action="{{ route('admin.hotel.destroy', $data->hotelID)}}" method="post">
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
      <a href="{{ route('admin.hotel.create')}}" class="badge badge-secondary">Add New Room</a>
    </div>
  </div>
@endsection