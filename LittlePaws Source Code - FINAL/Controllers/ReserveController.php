<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function is_admin()
    {
        if(Auth::user()->role != 'Admin') return abort('403');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->is_admin();

        $bookings = DB::table('reservations')
                    ->join('users', 'reservations.userID', '=', 'users.userID')
                    ->join('hotels', 'reservations.hotelID', '=', 'hotels.hotelID')
                    ->select('reservations.*', 'users.name', 'hotels.hotelType')
                    ->get();

        return view('admin.reserve', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reserve');
    }

    public function reserve(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $days = $request->input('days');

        $dateDetails = [$startDate, $endDate, $days];

        $check = Reservation::all();
        if($check->isEmpty()) {
            $hotel = Hotel::all();
            return view('reserve.add', compact('hotel', 'dateDetails'));
        }

        else {
            $booked = DB::table('hotels')
                      ->join('reservations', 'hotels.hotelID', '=', 'reservations.hotelID')
                      ->select('hotels.*')
                      ->whereNotBetween('reservations.checkInDate', [$startDate, $endDate])
                      ->whereNotBetween('reservations.checkOutDate', [$startDate, $endDate])
                      ->get();

            $room = DB::table('hotels')
                     ->leftJoin('reservations', 'hotels.hotelID', '=', 'reservations.hotelID')
                     ->select('hotels.*')
                     ->where('reservations.hotelID', '=',  null)
                     ->get();

            $hotel = $booked->merge($room);
            $hotel = $hotel->sortBy('hotelID');
            
            if($hotel->isEmpty()) {
                return view('reserve')->with('noRoom', 'No room is available for the selected date range. Try again.');
            }

            return view('reserve.add', compact('hotel', 'dateDetails'));
        }
    }

    public function pay(Request $request)
    {
        $hotel = Hotel::find($request->input('hotelID'));

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $days = $request->input('days');

        $dateDetails = [$startDate, $endDate, $days];

        return view('reserve.pay', compact('hotel', 'dateDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'payMethod' => ['required'],
            'payAmt' => ['required', 'between:0,9999.99']
        ]);

        $reserve = new Reservation([
            'hotelID' => $request->get('hotelID'),
            'userID' => Auth::user()->userID,
            'petQty' => $request->get('petQty'),
            'checkInDate' => $request->get('checkInDate'),
            'checkOutDate' => $request->get('checkOutDate'),
            'payMethod' => $request->get('payMethod'),
            'payAmt' => $request->get('payAmt')
        ]);

        $reserve->save();
        return view('/reserve/success')->with('success', 'Your room has been successfully booked.');
    }

    public function show()
    {
        $reserveAll = DB::table('reservations')
                   ->join('hotels', 'reservations.hotelID', '=', 'hotels.hotelID')
                   ->join('users', 'reservations.userID', '=', 'users.userID')
                   ->select('reservations.*', 'hotels.hotelType')
                   ->get();
        
        $reserve = []; 
        foreach ($reserveAll as $key => $value) {
            if ($value->userID == Auth::user()->userID) {
                $reserve[] = $value;
                $reserveAll->forget($key);
            }
        }
                   
        return view('/reserveHistory', compact('reserve'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookID)
    {
        $reserve = Reservation::find($bookID);

        $reserve->delete();
        return redirect('admin/reserve')->with('success', 'The reservation has been deleted.');
    }
}
