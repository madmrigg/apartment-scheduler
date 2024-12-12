<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\User;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = app(Apartment::class)->all();

        return view('apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("apartment.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ["name" => 'required']);

        app(Apartment::class)->create(['name'=> $request->name]);

        return redirect()->route("apartment.index");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $users = app(User::class)->pluck('name', 'id');
        $residents = $apartment->residents->pluck('id')->toArray();

        return view("apartment.edit", compact('apartment', 'users','residents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {

        User::where('apartment_id', $apartment->id)->update(['apartment_id' => null]);
        foreach ($request['residents'] as $resident) {
            User::find($resident)->update(['apartment_id' => $apartment->id]);
        }
        $apartment->update(['name' => $request['name']]);

        return redirect()->route('apartment.edit', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
