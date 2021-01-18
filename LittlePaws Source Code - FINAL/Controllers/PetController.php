<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
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
        $pets = Pet::all();
        return view('admin.pet', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->is_admin();
        return view('admin.pet.add');
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
            'petName' => ['required', 'string', 'max:25'],
            'petType' => ['required', 'string', 'max:25'],
            'petAge' => ['required', 'between:0,100'],
            'petImage' => ['required', 'image']
        ]);

        $pet = new Pet([
            'petName' => $request->get('petName'),
            'petType' => $request->get('petType'),
            'petAge' => $request->get('petAge'),
            'petImage' => $request->file('petImage')
        ]);

        $pet->save();
        return redirect('/admin/pet')->with('success', 'The new pet has been added.');
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit($petID)
    {
        $this->is_admin();

        $pet = Pet::find($petID);
        return view('admin.pet.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $petID)
    {
        $this->is_admin();

        $request->validate([
            'petName' => ['required', 'string', 'max:25'],
            'petType' => ['required', 'string', 'max:25'],
            'petAge' => ['required', 'between:0,100'],
            'petImage' => ['required', 'image']
        ]);

        $pet = Pet::find($petID);
        $pet->petName = $request->get('petName');
        $pet->petType = $request->get('petType');
        $pet->petAge = $request->get('petAge');
        $pet->petImage = $request->file('petImage');

        $pet->save();
        return redirect('/admin/pet')->with('success', 'The pet details has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($petID)
    {
        $this->is_admin();

        $pet = Pet::find($petID);

        $pet->delete();
        return redirect('/admin/pet')->with('success', 'The pet has been deleted.');
    }
}
