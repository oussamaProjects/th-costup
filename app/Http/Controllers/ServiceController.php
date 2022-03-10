<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ServiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        $formatted_services =  array(
            array(
                'name' => '',
                'description' => '',
                'parent_name' => ''
            )
        );

        foreach ($services as $key => $service) {
            $category = $service->categories()->get();
            $formatted_services[$key]['id']          = $service->id;
            $formatted_services[$key]['name']        = $service->name;
            $formatted_services[$key]['description'] = $service->description;

            if (!$category->isEmpty()) {
                $formatted_services[$key]['category_name'] = $category[0]->name;
            }
        }

        return Inertia::render('Components/Services/Index', [
            'services' => $services,
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

        $validates = $request->validate([
            'name' => 'required',
            'unit_measure' => 'required',
            'price' => 'required',
            'profit_margin_p_c' => 'required',
            'category_id' => 'required',
        ]);

        $service = new Service;
        $check_name = Service::where('name', 'like', $request->input('name'))->first();

        if ($check_name !== null) {
            return Redirect::route('settings')->with('flash.failures.form.store.services', 'Le nom de la categorie  "' . $service->name . '" exist deja !');
        }

        $service->name = $request->input('name');
        $service->description = $request->input('description') ?? " -- ";
        $service->unit_measure = $request->input('unit_measure');
        $service->qty = $request->input('qty') ?? 0;
        $service->occup_hour = $request->input('occup_hour');
        $service->price = $request->input('price');
        $service->profit_margin_p_c = $request->input('profit_margin_p_c');
        $service->category_id = $request->input('category_id') ?? 0;
        $service->save();

        return Redirect::route('settings')->with('flash.success.form.store.services', 'Le service "' . $service->name . '" a été enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {

        $request->validate([
            'name' => 'required',
            'unit_measure' => 'required',
            'occup_hour' => 'required',
            'price' => 'required',
            'profit_margin_p_c' => 'required',
            'category_id' => 'required',
        ]);

        $check_name = Service::where('name', 'like', $request->input('name'))->first();

        $service->description = $request->input('description') ?? " -- ";
        $service->unit_measure = $request->input('unit_measure');
        $service->qty = $request->input('qty') ?? 0;
        $service->occup_hour = $request->input('occup_hour');
        $service->price = $request->input('price');
        $service->profit_margin_p_c = $request->input('profit_margin_p_c');
        $service->category_id = $request->input('category_id') ?? 0;

        if ($check_name !== null) {
            $service->save();
            // return Redirect::route('settings')->with('flash.failures.form.update.services', 'La categorie "' . $service->name . '" exist deja !');
        }

        $service->name = $request->input('name');
        $service->save();

        // return Redirect::route('settings')->with('flash.success.form.update.services', 'Le service "' . $service->name . '" a été bien modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return Redirect::route('settings')->with('flash.success.list.services', 'Le service ' . $service->name . ' a été supprimer !');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function getSelectedServices(String $services_id)
    {
        $services = Service::whereIn('id', explode(',', $services_id))->get();
        $formatted_services =  array();

        foreach ($services as $service_key => $service) {

            $formatted_services[$service_key]['id']                = $service->id;
            $formatted_services[$service_key]['name']              = $service->name;
            $formatted_services[$service_key]['description']       = $service->description;
            $formatted_services[$service_key]['unit_measure']      = $service->unit_measure;
            $formatted_services[$service_key]['qty']               = $service->qty;
            $formatted_services[$service_key]['percent_imputed']   = $service->percent_imputed;
            $formatted_services[$service_key]['occup_hour']        = $service->occup_hour;
            $formatted_services[$service_key]['price']             = $service->price;
            $formatted_services[$service_key]['total']             = $service->total;
            $formatted_services[$service_key]['profit_margin_p_c'] = $service->profit_margin_p_c;
            $formatted_services[$service_key]['total_plus_margin'] = $service->total_plus_margin;
            $formatted_services[$service_key]['saved']             = 0;
        }

        return $services;
    }
}
