<?php

namespace App\Http\Controllers;

use App\Models\History_statue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HistoryStatueController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history_statues = History_statue::all();
        return Inertia::render('Components/HistoryStatue/Index', [
            'history_statues' => $history_statues
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
        ]);

        $history_statue = new History_statue;
        $check_name = History_statue::where('name', 'like', $request->input('name'))->first();

        if ($check_name !== null) {
            return Redirect::route('settings')->with('flash.failures.form.store.history_statues', 'Le nom du statue  "' . $history_statue->name . '" exist deja !');
        }

        $history_statue->name = $request->input('name');
        $history_statue->description = $request->input('description') ?? " -- ";
        $history_statue->category_id = $request->input('category_id') ?? 0;
        $history_statue->save();

        return Redirect::route('settings')->with('flash.success.form.store.history_statues', 'Le statue  "' . $history_statue->name . '" a été enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(History_statue $history_statue)
    {
        return $history_statue;
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History_statue $history_statue)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $check_name = History_statue::where('name', 'like', $request->input('name'))->first();

        $history_statue->description = $request->input('description') ?? " -- ";
        $history_statue->category_id = $request->input('category_id') ?? 0;
        if ($check_name !== null) {
            $history_statue->save();
            return Redirect::route('settings')->with('flash.failures.form.update.history_statues', 'Le statue "' . $history_statue->name . '" exist deja !');
        }

        $history_statue->name = $request->input('name');
        $history_statue->save();

        return Redirect::route('settings')->with('flash.success.form.update.history_statues', 'Le statue "' . $history_statue->name . '" a été bien modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  History_statue $history_statue
     * @return \Illuminate\Http\Response
     */
    public function destroy(History_statue $history_statue)
    {
        $history_statue->delete();
        return Redirect::route('settings')->with('flash.success.list.history_statues', 'Le statue ' . $history_statue->name . ' a été supprimer !');
    }
}
