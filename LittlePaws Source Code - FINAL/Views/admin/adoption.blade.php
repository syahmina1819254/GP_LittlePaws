@extends('layouts.admin')

@section('title', 'Adoptions')

@section('content')
<div class="container mx-auto" style="padding: 10px; margin: 10px">
  <br/>
  <h3>Adoption Requests</h3>
  
  @if(session()->get('success'))
	<div class="alert alert-success text-center">
	  {{ session()->get('success') }}  
	</div>
  @endif
  
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
          <th scope="col" class="text-center">Adopt ID</th>
          <th scope="col" class="text-center">User ID</th>
          <th scope="col" class="text-center">User Name</th>
          <th scope="col" class="text-center">Pet Name</th>
          <th scope="col" class="text-center">Pet Type</th>
          <th scope="col" class="text-center">Pet Age</th>
          <th scope="col" class="text-center">Request Date</th>
          <th scope="col" class="text-center" colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($adopt as $key => $data)
        <tr>
            <th scope="row" class="text-center">{{$data->adoptID}}</th>
            <td class="text-center">{{$data->userID}}</td>
            <td class="text-center">{{$data->name}}</td>
            <td class="text-center">{{$data->petName}}</td>
            <td class="text-center">{{$data->petType}}</td>
            <td class="text-center">{{$data->petAge}}</td>
            <td class="text-center">{{$data->reqDate}}</td>
            <td class="text-center">
                <form action="{{ route('admin.adoption.approve', $data->adoptID) }}" method="post">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-secondary">Approve</button>
                </form>
            </td>
            <td class="text-center">
                <form action="{{ route('admin.adoption.reject', $data->adoptID) }}" method="post">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-secondary">Reject</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection