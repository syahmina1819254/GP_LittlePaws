@extends('layouts.master')

<link href="{{ asset('css/reserve.css') }}" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $('#startDate')[0].setAttribute('min', today);
        
        $('#startDate').change(function(){
            var date = $('#startDate').val();
            $('#endDate')[0].setAttribute('min', date);
        });

        $('#endDate').change(function(){
            var start = new Date($('#startDate').val());
            var end = new Date($('#endDate').val());

            var msPerDay = 1000 * 60 * 60 * 24;
            var msBetween = end.getTime() - start.getTime();

            //01-01-2021 - 01-01-2021 counts as one day
            var days = (msBetween / msPerDay) + 1;

            $('.days').html(days + " days");
            $('#days').html('<input type="hidden" name="days" value=' + days + '>');
        });
    });
</script>

@section('title', 'Reservation')

@section('content')
    <div class="container mx-auto" style="padding: 10px; margin: 10px">
        <h3>Reservation</h3>

        @if(!empty($noRoom))
            <div class="alert alert-danger"> {{ $noRoom }}</div>
        @endif
        <form action="{{ route('reserve.add') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Check In Date</span>
                </div>
                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="startDate" name="startDate" min="" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Check Out Date</span>
                </div>
                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="endDate" name="endDate" min="" required>
            </div>

            <div class="duration" style="display: inline-block">
                <p>Duration of stay: </p>
                <p class="days"></p>
                <div id="days"></div>
            </div>
            <br>
            <button type="submit" class="btn btn-secondary">Check Available Rooms</button>
        </form>
    </div>
@endsection