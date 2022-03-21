<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return Inertia::render('Components/Clients/Index', [
            'clients' => $clients
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

        $client = new Client();
        $check_name = Client::where('name', 'like', $request->input('name'))->first();

        if ($check_name !== null) {
            return Redirect::route('settings')->with('flash.failures.form.store.clients', 'Le nom du client  "' . $client->name . '" exist deja !');
        }

        $client->name = $request->input('name');
        $client->description = $request->input('description') ?? " -- ";
        $client->address = $request->input('address') ?? " -- ";
        $client->save();

        return Redirect::back()->with('flash.success.form.store.clients', 'Le client  "' . $client->name . '" a été enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $check_name = Client::where('name', 'like', $request->input('name'))->first();

        $client->description = $request->input('description') ?? " -- ";

        if ($check_name !== null) {
            $client->save();
            return Redirect::route('settings')->with('flash.failures.form.update.clients', 'Le client "' . $client->name . '" a été bien modifié ! mais le nom exist deja !');
        }

        $client->name = $request->input('name');
        $client->description = $request->input('description');
        $client->address = $request->input('address');
        $client->save();

        return Redirect::route('settings')->with('flash.success.form.update.clients', 'Le client "' . $client->name . '" a été bien modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return Redirect::back()->with('flash.success.list.clients', 'Le client ' . $client->name . ' a été supprimer !');
    }
}
