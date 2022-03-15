<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Project;
use Illuminate\Http\Request;

class SAGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a Project Service resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSAGProjectResource(Request $requestArray)
    {
        foreach ($requestArray->all() as $key => $request) {
            if ($request != null) {

                $project_id  = $request['project_id'];
                $resource_id = $request['service_id'];
                $sag_id      = 1;

                $project = Project::findOrFail($project_id);

                $data = [
                    'sag_id' => $sag_id,
                    'qty'    => $request['qty'],
                    'actual' => $request['actual'],
                    'gap'    => $request['gap'],
                ];


                if (!$project->sag_resources->contains($resource_id))
                    $project->sag_resources()->attach($resource_id, $data);
                else
                    $project->sag_resources()->updateExistingPivot($resource_id, $data);
            }
        }
    }

    /**
     * Store a Project Category resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSAGProjectCategories(Request $request)
    {

        $project_id  = $request->project_id;
        $category_id = $request->category_id;
        $sag_id      = 1;

        $project = Project::findOrFail($project_id);

        $data = [
            'sag_id' => $sag_id,
            'qty'    => $request['qty'],
            'actual' => $request['actual'],
            'gap'    => $request['gap'],
        ];

        if (!$project->sag_categories->contains($category_id))
            $project->sag_categories()->attach($category_id, $data);
        else
            $project->sag_categories()->updateExistingPivot($category_id, $data);

        // return Redirect::route('settings')->with('flash.success.calculator.categories', 'Le project  "' . $project->name . '" a été modifié !');
    }

    /**
     * Delete a Project Service resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSAGProjectResource(Request $request)
    {
        if ($request != null) {
            $project_id = $request['project_id'];
            $resource_id = $request['service_id'];

            $project = Project::findOrFail($project_id);

            if ($project->sag_resources->contains($resource_id))
                try {
                    $project->sag_resources()->detach($resource_id);
                } catch (\Throwable $th) {
                    echo $th;
                }
        }
    }

    /**
     * Store a Project Service resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSAGMovementNote(Request $requestArray)
    {
        foreach ($requestArray->all() as $key => $request) {
            if ($request != null) {
                
                $history = new History();

                $project_id  = $request['project_id'];

                $sag_resources_id   = $request['sag_resources_id'];
                $note               = $request['note'];
                $history_statues_id = $request['history_statues_id'];
                $movement           = $request['movement'];

                $history->sag_resources_id   = $sag_resources_id;
                $history->note               = $note;
                $history->history_statues_id = $history_statues_id;
                $history->movement           = $movement; 

                $history->save();

            }
        }
    }
}
