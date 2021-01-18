@extends('layouts.master')

<link href="{{ asset('css/reserve.css') }}" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title', 'Reservation')

@section('content')
    <div class="container mx-auto" style="padding: 10px; margin: 10px">
        <h3>Reservation</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Room Number</th>
                    <th scope="col" class="text-center">Room Type</th>
                    <th scope="col" class="text-center">Max Pet Quantity</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotel as $key => $data)
                <tr>
                    <th scope="row" class="text-center">{{$data->hotelID}}</th>
                    <td class="text-center">{{$data->hotelType}}</td>
                    <td class="text-center">{{$data->maxPetQty}}</td>
                    <td class="text-center">{{$data->hotelPrice}}</td>
                    <td class="text-center">
                        <form action="{{ route('reserve.pay') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{$dateDetails[0]}}" name="startDate">
                            <input type="hidden" value="{{$dateDetails[1]}}" name="endDate">
                            <input type="hidden" value="{{$dateDetails[2]}}" name="days">
                            <input type="hidden" value="{{$data->hotelID}}" name="hotelID">
                            <button type="submit" class="btn btn-secondary">Book Now</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            <t/body>
        </table>
    </div>
@endsection