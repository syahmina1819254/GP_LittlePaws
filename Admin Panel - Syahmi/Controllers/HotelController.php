<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
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
        $hotels = Hotel::all();
        return view('admin.hotel', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->is_admin();
        return view('admin.hotel.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->is_admin();

        $request->validate([
            'hotelType' => ['required', 'string', 'max:25'],
            'maxPetQty' => ['required', 'between:0,10'],
            'hotelPrice' => ['required', 'between:0,9999.99'],
        ]);

        $hotel = new Hotel([
            'hotelType' => $request->get('hotelType'),
            'maxPetQty' => $request->get('maxPetQty'),
            'hotelPrice' => $request->get('hotelPrice')
        ]);

        $hotel->save();
        return redirect('/admin/hotel')->with('success', 'The new room has been added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($hotelID)
    {
        $this->is_admin();

        $hotel = Hotel::find($hotelID);
        return view('admin.hotel.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hotelID)
    {
        $this->is_admin();

        $request->validate([
            'hotelType' => ['required', 'string', 'max:25'],
            'maxPetQty' => ['required', 'between:0,10'],
            'hotelPrice' => ['required', 'between:0,9999.99'],
        ]);

        $hotel = Hotel::find($hotelID);
        $hotel->hotelType = $request->get('hotelType');
        $hotel->maxPetQty = $request->get('maxPetQty');
        $hotel->hotelPrice = $request->get('hotelPrice');
        
        $hotel->save();
        return redirect('/admin/hotel')->with('success', 'The room details has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($hotelID)
    {
        $this->is_admin();

        $hotel = Hotel::find($hotelID);

        $hotel->delete();
        return redirect('/admin/hotel')->with('success', 'The room has been deleted.');
    }
}
