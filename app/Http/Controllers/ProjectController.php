<?php

namespace App\Http\Controllers;

use App\Charts\ResourcesCategoriesChart;
use App\Models\Category;
use App\Models\Factor;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return Inertia::render('Components/Projects/Index', [
            'projects' => $projects
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

        $project = new Project;
        $check_name = Project::where('name', 'like', $request->input('name'))->first();

        if ($check_name !== null) {
            return Redirect::route('settings')->with('flash.failures.form.store.projects', 'Le nom de le project  "' . $project->name . '" exist deja !');
        }

        $project->name = $request->input('name');
        $project->description = $request->input('description') ?? " -- ";
        $project->save();

        return Redirect::back()->with('flash.success.form.store.projects', 'Le project  "' . $project->name . '" a été enregistrée !');
    }

    /**
     * Store a Project Service resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProjectServices(Request $requestArray)
    {

        foreach ($requestArray->all() as $key => $request) {
            if ($request != null) {
                $project_id = $request['project_id'];
                $service_id = $request['service_id'];

                $project = Project::findOrFail($project_id);

                $data = [
                    'project_id' => $project_id,
                    'qty' => $request['qty'],
                    'percent_imputed' => 0,
                    'occup_hour' => $request['occup_hour'],
                    'price' => $request['price'],
                    'total' => $request['total'],
                    'profit_margin_p_c' => $request['profit_margin_p_c'],
                    'total_plus_margin' => $request['total_plus_margin'],
                ];


                if (!$project->services->contains($service_id))
                    $project->services()->attach($service_id, $data);
                else
                    $project->services()->updateExistingPivot($service_id, $data);
            }
        }
    }

    /**
     * Delete a Project Service resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteProjectServices(Request $request)
    {

        if ($request != null) {
            $project_id = $request['project_id'];
            $service_id = $request['service_id'];

            $project = Project::findOrFail($project_id);

            if ($project->services->contains($service_id))
                $project->services()->detach($service_id);
        }
    }

    /**
     * Store a Project Category resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProjectCategories(Request $request)
    {

        $project_id = $request->project_id;
        $category_id = $request->category_id;

        $project = Project::findOrFail($project_id);

        $data = [
            'project_id' => $project_id,
            'qty' => $request->qty,
            'occup_hour' => $request->occup_hour,
            'price' => $request->price,
            'total' => $request->total,
            'profit_margin_p_c' => $request->profit_margin_p_c,
            'total_plus_margin' => $request->total_plus_margin,
        ];

        if (!$project->categories->contains($category_id))
            $project->categories()->attach($category_id, $data);
        else
            $project->categories()->updateExistingPivot($category_id, $data);

        // return Redirect::route('settings')->with('flash.success.calculator.categories', 'Le project  "' . $project->name . '" a été modifié !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return UtilityController::project_calculation($project);
    }

    /**
     * getProjectValues
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProjectValues(Project $project)
    {

        $formatted_categories = array();
        $categories = Category::where('parent_id', '!=', 0)->orderBy('parent_id', 'ASC')->get();

        foreach ($categories as $cat_key => $category) {
            $parents = $category->parent()->get();

            $formatted_categories[$cat_key]['id']                = $category->id;
            $formatted_categories[$cat_key]['name']              = $category->name;
            $formatted_categories[$cat_key]['description']       = $category->description;

            $category_values = DB::table('projects')
                ->select('categories.*', 'projects_categories.*')
                ->join('projects_categories', 'projects_categories.project_id', 'projects.id')
                ->rightJoin('categories', 'categories.id', 'projects_categories.category_id')
                ->where('projects.id', '=', $project->id)
                ->where('categories.id', '=', $category->id)
                ->distinct()
                ->get();

            if (!$category_values->isEmpty()) {
                $formatted_categories[$cat_key]['qty']               = $category_values[0]->qty;
                $formatted_categories[$cat_key]['occup_hour']        = $category_values[0]->occup_hour;
                $formatted_categories[$cat_key]['price']             = $category_values[0]->price;
                $formatted_categories[$cat_key]['total']             = $category_values[0]->total;
                $formatted_categories[$cat_key]['profit_margin_p_c'] = $category_values[0]->profit_margin_p_c;
                $formatted_categories[$cat_key]['total_plus_margin'] = $category_values[0]->total_plus_margin;
            } else {
                $formatted_categories[$cat_key]['qty']               = 0;
                $formatted_categories[$cat_key]['occup_hour']        = 0;
                $formatted_categories[$cat_key]['price']             = 0;
                $formatted_categories[$cat_key]['total']             = 0;
                $formatted_categories[$cat_key]['profit_margin_p_c'] = 0;
                $formatted_categories[$cat_key]['total_plus_margin'] = 0;
            }

            if (!$parents->isEmpty()) {
                $formatted_categories[$cat_key]['parent_id']    = $parents[0]->id;
                $formatted_categories[$cat_key]['parent_name']  = $parents[0]->name;
            }

            $services = Service::where('category_id', '=', $category->id)->get();

            $formatted_categories[$cat_key]['services'] = array();
            foreach ($services as $serv_key => $service) {

                $services_values = DB::table('projects')
                    ->select('projects_services.*')
                    ->join('projects_services', 'projects_services.project_id', 'projects.id')
                    ->join('services', 'services.id', 'projects_services.service_id')
                    ->where('projects.id', '=', $project->id)
                    ->where('services.id', '=', $service->id)
                    ->distinct()
                    ->get();

                if (!$services_values->isEmpty()) {

                    array_push($formatted_categories[$cat_key]['services'], array(
                        'id' => $service->id,
                        'name'         => $service->name,
                        'description'  => $service->description,
                        'unit_measure' => $service->unit_measure,
                        'qty'               => $services_values[0]->qty,
                        'percent_imputed'   => $services_values[0]->percent_imputed,
                        'occup_hour'        => $services_values[0]->occup_hour,
                        'price'             => $services_values[0]->price,
                        'total'             => $services_values[0]->total,
                        'profit_margin_p_c' => $services_values[0]->profit_margin_p_c,
                        'total_plus_margin' => $services_values[0]->total_plus_margin,
                        'saved'             => 1
                    ));
                }
            }
        }

        return $formatted_categories;
    }

    /**
     * getProjectFactors
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProjectFactors(Project $project)
    {
        return $project->factors()->get();
    }

    /**
     * getFactorsNotInProject
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFactorsNotInProject(Project $project)
    {

        $factors_project = DB::table('projects')
            ->select('factors.*')
            ->join('projects_factors', 'projects_factors.project_id', 'projects.id')
            ->join('factors', 'factors.id', 'projects_factors.factor_id')
            ->where('projects.id', '=', $project->id)
            ->get();

        $factors = DB::table('factors')
            ->whereNotIn('factors.id', $factors_project->pluck('id')->toArray())
            ->get();

        return $factors;
    }

    /**
     * getProjectExtras
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProjectExtras(Project $project)
    {
        $extras = array(
            "smph_custommer_demand" => $project->smph_custommer_demand,
            "smph_production_available_time" => $project->smph_production_available_time,
            "lmph_custommer_demand" => $project->lmph_custommer_demand,
            "lmph_production_available_time" => $project->lmph_production_available_time,
        );

        return $extras;
    }


    /**
     * storeProjectValues
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeProjectFactors(Request $requestArray)
    {
        $project_id = $requestArray->all()[0]['project_id'];
        $project = Project::findOrFail($project_id);

        $project->factors()->detach();

        foreach ($requestArray->all() as $key => $request) {
            if ($request != null) {

                $factor_id = $request['factor_id'];

                $data = [
                    'project_id' => $project_id,
                    'value' => $request['value'],
                ];

                $project->factors()->attach($factor_id, $data);

                // if (!$project->factors->contains($factor_id))
                // else
                //     $project->factors()->updateExistingPivot($factor_id, $data);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $check_name = Project::where('name', 'like', $request->input('name'))->first();

        $project->description = $request->input('description') ?? " -- ";

        if ($check_name !== null) {
            $project->save();
            return Redirect::route('settings')->with('flash.failures.form.update.projects', 'Le project "' . $project->name . '" a été bien modifié ! mais le nom exist deja !');
        }

        $project->name = $request->input('name');
        $project->save();

        return Redirect::route('settings')->with('flash.success.form.update.projects', 'Le project "' . $project->name . '" a été bien modifié !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeProjectExtras(Request $request)
    {

        $project = Project::where('id', '=', $request->input('project_id'))->first();
        $project->smph_custommer_demand = $request['extras']['smph_custommer_demand'] ?? 0;
        $project->smph_production_available_time = $request['extras']['smph_production_available_time'] ?? 0;
        $project->lmph_custommer_demand = $request['extras']['lmph_custommer_demand'] ?? 0;
        $project->lmph_production_available_time = $request['extras']['lmph_production_available_time'] ?? 0;

        $project->save();

        return Redirect::back()->with('flash.success.form.store.extras', 'Le project "' . $project->name . '" a été bien modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return Redirect::back()->with('flash.success.list.projects', 'Le project ' . $project->name . ' a été supprimer !');
    }


    public function projectsDetails(ResourcesCategoriesChart $chart)
    {

        $projects = Project::all(); 

        foreach ($projects as $key => $project) {
            $projects[$key]['Chart'] =  $chart->buildBarChart($project);
        }

        return Inertia::render('Projects', [
            'projects' => $projects,
        ]);
    }
}
