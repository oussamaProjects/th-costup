<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia; 

class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::all();
        return Inertia::render('Components/Shifts/Index', [
            'shifts' => $shifts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
        ]);

        $client = new Shift();
        $check_name = Shift::where('name', 'like', $request->input('name'))->first();

        if ($check_name !== null) {
            return Redirect::route('settings')->with('flash.failures.form.store.shifts', 'Le nom du client  "' . $client->name . '" exist deja !');
        }

        $client->name = $request->input('name');
        $client->resource = $request->input('resource') ?? " -- "; 
        $client->save();

        return Redirect::back()->with('flash.success.form.store.shifts', 'Le client  "' . $client->name . '" a été enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $client)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $check_name = Shift::where('name', 'like', $request->input('name'))->first();

        $client->resource = $request->input('resource') ?? " -- ";

        if ($check_name !== null) {
            $client->save();
            return Redirect::route('settings')->with('flash.failures.form.update.shifts', 'Le client "' . $client->name . '" a été bien modifié ! mais le nom exist deja !');
        }

        $client->name = $request->input('name');
        $client->resource = $request->input('resource'); 
        $client->save();

        return Redirect::route('settings')->with('flash.success.form.update.shifts', 'Le client "' . $client->name . '" a été bien modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $client)
    {
        $client->delete();
        return Redirect::back()->with('flash.success.list.shifts', 'Le client ' . $client->name . ' a été supprimer !');
    }
}
