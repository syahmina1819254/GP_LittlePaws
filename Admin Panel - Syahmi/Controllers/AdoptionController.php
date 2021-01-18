<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdoptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pet = DB::table('pets')
               ->leftJoin('adoptions', 'pets.petID', '=', 'adoptions.petID')
               ->select('pets.*')
               ->where('adoptions.petID', '=', null)
               ->orWhere('adoptions.reqStatus', '=', 'Rejected')
               ->get();

        if($pet->isEmpty()) {
            return view('/adoption', compact('pet'))->with('noPet', 'There are currently no pets available for you to adopt.');
        }
        
        return view('/adoption', compact('pet'));
    }

    public function list()
    {
        $adopt = DB::table('adoptions')
               ->join('pets', 'adoptions.petID', '=', 'pets.petID')
               ->join('users', 'adoptions.userID', '=', 'users.userID')
               ->select('adoptions.*', 'users.name', 'pets.petName', 'pets.petType', 'pets.petAge')
               ->where('adoptions.reqStatus', '=', 'Pending')
               ->get();

        return view('/admin/adoption', compact('adopt'));
    }

    public function approve($adoptID)
    {
        $adopt = Adoption::find($adoptID);
        $adopt->reqStatus = 'Approved';
        
        $adopt->save();
        return redirect('/admin/adoption')->with('success', 'The request has been approved.');
    }

    public function reject($adoptID)
    {
        $adopt = Adoption::find($adoptID);
        $adopt->reqStatus = 'Rejected';
        
        $adopt->save();
        return redirect('/admin/adoption')->with('success', 'The request has been rejected.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adoption = new Adoption([
            'userID' => Auth::user()->userID,
            'petID' => $request->get('petID'),
            'reqDate' => $request->get('reqDate'),
            'reqStatus' => 'Pending'
        ]);

        $adoption->save();
        return redirect('/adoption')->with('success', 'Your adoption request has been submitted for processing.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $adoptAll = DB::table('adoptions')
                    ->join('pets', 'adoptions.petID', '=', 'pets.petID')
                    ->join('users', 'adoptions.userID', '=', 'users.userID')
                    ->select('adoptions.*', 'pets.petName', 'pets.petType', 'pets.petAge')
                    ->get();

        $adopt = []; 
        foreach ($adoptAll as $key => $value) {
            if ($value->userID == Auth::user()->userID) {
                $adopt[] = $value;
                $adoptAll->forget($key);
            }
        }

        return view('/adoptionStatus', compact('adopt'));
    }
}
