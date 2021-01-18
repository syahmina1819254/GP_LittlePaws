@extends('layouts.admin')

@section('title', 'Pets')

@section('content')
<div class="container mx-auto" style="padding: 10px; margin: 10px">
  <br/>
  <h3>Pet List</h3>    

  @if(session()->get('success'))
    <div class="alert alert-success text-center">
      {{ session()->get('success') }}  
    </div>
  @endif

  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
          <th scope="col" class="text-center">ID</th>
          <th scope="col" class="text-center">Pet Name</th>
          <th scope="col" class="text-center">Pet Type</th>
          <th scope="col" class="text-center">Pet Age</th>
          <th scope="col" class="text-center">Pet Image</th>
          <th scope="col" class="text-center" colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pets as $key => $data)
        <tr>
            <th scope="row" class="text-center">{{++$key}}</th>
            <td class="text-center">{{$data->petName}}</td>
            <td class="text-center">{{$data->petType}}</td>
            <td class="text-center">{{$data->petAge}}</td>
            <td class="text-center">{{$data->petImage}}</td>
            <td class="text-center">
                <form action="{{ route('admin.pet.edit', $data->petID)}}" method="post">
                  @csrf
                  <button type="submit">Edit</button>
                </form>
            </td>
            <td class="text-center">
                <form action="{{ route('admin.pet.destroy', $data->petID)}}" method="post">
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
    <a style="margin: 19px;" href="{{ route('admin.pet.create')}}" class="badge badge-secondary">Add New Pet</a>
  </div>
<div>
@endsection