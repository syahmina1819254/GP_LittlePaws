@extends('layouts.master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $('.date').html('<input type="hidden" name="reqDate" value="' + today + '">');
    });
</script>

@section('title', 'Adoption')

@section('content')
<div class="container mx-auto text-center" style="padding: 10px; margin: 10px">
  <h3>Adoptions</h1>
  <h4>Please read the terms and conditions before making a request.</h4>

  @if(session()->get('success'))
      <div class="alert alert-success text-center" style="width: 50rem">
        {{ session()->get('success') }}  
      </div>
  @endif

  @if(!empty($noPet))
      <div class="alert alert-danger"> {{ $noPet }}</div>
  @endif

  @foreach($pet as $key => $data)
    <div class="card mx-auto text-left" style="width: 50rem; padding: 25px">
        <img class="card-img-top" src="" alt="Pet">
        <form action="{{route('adoption.store')}}" method="post">
          @csrf
          <div class="card-body">
            <p class="card-text">Pet Name: {{$data->petName}}</p> <p>Pet Type: {{$data->petType}}</p> <p>Age: {{$data->petAge}}</p>
            <button type="submit" class="btn btn-secondary">Adopt Me</button></td>
          </div>

          <input type="hidden" name="petID" value="{{$data->petID}}">
          <div class="date"></div>
        </form>  
    </div>
  @endforeach
  <div class="card mx-auto text-left" style="width: 50rem; margin-top: 25px; padding: 25px">
      <h2>Terms and Conditions</h2>
      <p>1. The request are on first come first serve basis</p>
      <p>2. We will give a call for interview for your adoption request</p>
      <p>3. A user can only request for a pet at a time. You cannot submit the same request of a pet more than once or else your submission will be rejected</p>
      <p>4. LittlePaws has the authority to reject your request</p>
  </div>
</div>
@endsection