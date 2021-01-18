@extends('layouts.admin');

@section('title', 'Edit Pet');

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
    <form method="post" action="{{ route('admin.pet.update', $pet->petID) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Pet Name</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="petName" value="{{ $pet->petName }}">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Pet Type</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="petType" value="{{ $pet->petType }}">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Pet Age (up to 100 years old)</span>
          </div>
          <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="petAge" value="{{ $pet->petAge }}">
        </div>
        <div class="input-group mb-3">
           <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="petImage" value="{{ $pet->petImage }}">
              <label class="custom-file-label" for="inputGroupFile01">Choose image</label>
           </div>
        </div>
        <button type="submit" class="btn btn-secondary">Submit Changes</button>
    </form>
  </div>
@endsection