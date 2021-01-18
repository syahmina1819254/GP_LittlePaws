@extends('layouts.master')

<link href="{{ asset('css/reserve.css') }}" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var val = $('#qty').val();
        setData(val);

        $('#add').click(function(){
            if(val < $('#max').val()) val++;
            $('#qty').val(val);
            setData(val);
        });

        $('#sub').click(function(){
            if(val > 1) val--;
            $('#qty').val(val);
            setData(val);
        });

        $("input[type='radio']").click(function() {
            $('#btnCheck').prop("disabled", !this.checked);
        });
    });

    function setData(val){
        var price = parseInt($('#cost').val()) + ((parseInt(val) - 1) * 15);
        $('.price').html(parseFloat(price).toFixed(2));
        $('.total').html(parseFloat(price * $('#days').val()).toFixed(2));
        
        $('.petQty').html(
            '<input type="hidden" value="' + $('#qty').val() + '" name="petQty"> ' +
            '<input type="hidden" value="' + price * $('#days').val() + '" name="payAmt"> '
        );
    };
</script>

@section('title', 'Reservation')

@section('content')
    <div class="container mx-auto" style="padding: 10px; margin: 10px">
        <h3>Payment</h3>

        <p><b>Room Number:</b> {{$hotel->hotelID}} </p>
        <p><b>Room Type:</b> {{$hotel->hotelType}} </p>
        <p><b>Check In Date:</b> {{$dateDetails[0]}} </p>
        <p><b>Check Out Date:</b> {{$dateDetails[1]}} </p>

        <label for="qty"><b>Pet Quantity:</b> </label>
        <input type="number" id="qty" value="1" name="qty" disabled>

        <input type="hidden" id="max" value="{{ $hotel->maxPetQty }}">
        <button id="add" class="btn btn-secondary">+</button>
        <button id="sub" class="btn btn-secondary">-</button>

        <input type="hidden" id="cost" value="{{ $hotel->hotelPrice }}">
        <input type="hidden" id="days" value="{{ $dateDetails[2] }}">

        <br>
        <div class="d-print-inline">RM <p class="price"></p> x {{ $dateDetails[2] }} days = RM <p class="total"></p></div>

        <form action="{{ route('reserve.store') }}" method="post">
            @csrf
            <input type="hidden" value="{{$hotel->hotelID}}" name="hotelID">
            <div class="petQty"></div>

            <input type="hidden" value="{{$dateDetails[0]}}" name="checkInDate">
            <input type="hidden" value="{{$dateDetails[1]}}" name="checkOutDate">

            <p><b>Payment Method:</b></p>
            <input type="radio" id="card" name="payMethod" value="Credit Card">
            <label for="card">Credit Card</label>

            <br>
            <input type="radio" id="online" name="payMethod" value="Online Payment">
            <label for="online">Online Payment</label>

            <br>
            <button type="submit" class="btn btn-secondary" disabled id="btnCheck">Confirm Booking</button>
        </form>
    </div>
@endsection

