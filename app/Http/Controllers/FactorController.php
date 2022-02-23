<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factors = Factor::all();
        return Inertia::render('Components/factors/Index', [
            'factors' => $factors
        ]);
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
            'value' => 'required',
        ]);

        $factor = new Factor();
        $check_name = Factor::where('name', 'like', $request->input('name'))->first();

        if ($check_name !== null) {
            return Redirect::route('settings')->with('flash.failures.form.store.factors', 'Le nom de le factor  "' . $factor->name . '" exist deja !');
        }

        $factor->name = $request->input('name');
        $factor->value = $request->input('value'); 
        $factor->save();

        return Redirect::back()->with('flash.success.form.store.factors', 'Le factor  "' . $factor->name . '" a été enregistrée !');
    }
  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Factor $factor)
    {
        return $factor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factor $factor)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        $check_name = Factor::where('name', 'like', $request->input('name'))->first();

        $factor->value = $request->input('value');
        $factor->type  = $request->input('type') ?? " -- ";

        if ($check_name !== null) {
            $factor->save();
            return Redirect::route('settings')->with('flash.failures.form.update.factors', 'Le factor "' . $factor->name . '" exist deja !');
        }

        $factor->name = $request->input('name');
        $factor->save();

        return Redirect::route('settings')->with('flash.success.form.update.factors', 'Le factor "' . $factor->name . '" a été bien modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Factor $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factor $factor)
    {
        $factor->delete();
        return Redirect::back()->with('flash.success.list.factors', 'Le factor ' . $factor->name . ' a été supprimer !');
    }
}
