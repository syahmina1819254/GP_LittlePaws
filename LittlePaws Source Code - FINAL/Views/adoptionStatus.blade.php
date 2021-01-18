@extends('layouts.master')

@section('title', 'Adoption Status')

@section('content')
<div class="container mx-auto" style="padding: 10px; margin: 10px">
  <br/>
  <h3>Adoption Status</h3>    
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr>
            <th scope="col" class="text-center">Pet Name</th>
            <th scope="col" class="text-center">Pet Type</th>
            <th scope="col" class="text-center">Pet Age</th>
            <th scope="col" class="text-center">Request Date</th>
            <th scope="col" class="text-center">Request Status</th>
          </tr>
      </thead>
      <tbody>
          @foreach($adopt as $key => $data)
          <tr>
              <th scope="row" class="text-center">{{$data->petName}}</th>
              <td class="text-center">{{$data->petType}}</td>
              <td class="text-center">{{$data->petAge}}</td>
              <td class="text-center">{{$data->reqDate}}</td>
              <td class="text-center">{{$data->reqStatus}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
<div>
@endsection