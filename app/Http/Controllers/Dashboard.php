<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Factor;
use App\Models\History_statue;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class Dashboard extends Controller
{
    public function index()
    {

        $projects = Project::all();
        $categories = Category::where('parent_id', '!=', '0')->orderBy('parent_id', 'ASC')->get();

        $child_categories = Category::where('parent_id', '!=', '0')->get();
        $services = Service::all();

        $formatted_categories =  array();
        $formatted_services =  array();

        foreach ($categories as $cat_key => $category) {

            $parents = $category->parent()->get();
            $formatted_categories[$cat_key]['id']              = $category->id;
            $formatted_categories[$cat_key]['name']            = $category->name;
            $formatted_categories[$cat_key]['description']     = $category->description;
            $formatted_categories[$cat_key]['qty']     = 0;
            $formatted_categories[$cat_key]['occup_hour']     = 0;
            $formatted_categories[$cat_key]['price']     = 0;
            $formatted_categories[$cat_key]['total']     = 0;
            $formatted_categories[$cat_key]['profit_margin_p_c']     = 0;
            $formatted_categories[$cat_key]['total_plus_margin']     = 0;

            if (!$parents->isEmpty()) {
                $formatted_categories[$cat_key]['parent_id'] = $parents[0]->id;
                $formatted_categories[$cat_key]['parent_name'] = $parents[0]->name;

                $category_services = $category->services()->get();

                foreach ($category_services as $serv_key => $service) {
                    $formatted_categories[$cat_key]['services'][$serv_key]['id']                = $service->id;
                    $formatted_categories[$cat_key]['services'][$serv_key]['name']              = $service->name;
                    $formatted_categories[$cat_key]['services'][$serv_key]['description']       = $service->description;
                    $formatted_categories[$cat_key]['services'][$serv_key]['unit_measure']      = $service->unit_measure;
                    $formatted_categories[$cat_key]['services'][$serv_key]['qty']               = $service->qty;
                    $formatted_categories[$cat_key]['services'][$serv_key]['percent_imputed']   = $service->percent_imputed;
                    $formatted_categories[$cat_key]['services'][$serv_key]['occup_hour']        = $service->occup_hour;
                    $formatted_categories[$cat_key]['services'][$serv_key]['price']             = $service->price;
                    $formatted_categories[$cat_key]['services'][$serv_key]['total']             = $service->total;
                    $formatted_categories[$cat_key]['services'][$serv_key]['profit_margin_p_c'] = $service->profit_margin_p_c;
                    $formatted_categories[$cat_key]['services'][$serv_key]['total_plus_margin'] = $service->total_plus_margin;
                    $formatted_categories[$cat_key]['services'][$serv_key]['saved']             = 0;
                }
            }
        }

        foreach ($categories as $cat_key => &$category) {
            $parents = $category->parent()->get();
            if (!$parents->isEmpty()) {
                $category['parent_name'] = $parents[0]->name;
            }
        }

        foreach ($services as $key => $service) {
            $category = $service->categories()->get();
            $formatted_services[$key]['id']                = $service->id;
            $formatted_services[$key]['name']              = $service->name;
            $formatted_services[$key]['description']       = $service->description;
            $formatted_services[$key]['unit_measure']      = $service->unit_measure;
            $formatted_services[$key]['qty']               = $service->qty;
            $formatted_services[$key]['occup_hour']        = $service->occup_hour;
            $formatted_services[$key]['price']             = $service->price;
            $formatted_services[$key]['profit_margin_p_c'] = $service->profit_margin_p_c;

            if (!$category->isEmpty()) {
                $formatted_services[$key]['category_name'] = $category[0]->name;
            }
        }

        return Inertia::render('Dashboard', [
            'projects' => $projects,
            'categories' => $categories,
            'formattedCategories' => $formatted_categories,
            'services' => $services,
            'formattedServices' => $formatted_services,
            'ChildCategories' => $child_categories,
        ]);
    }

    public function calculator()
    {

        $projects = Project::all();
        $factors = Factor::all();
        $categories = Category::where('parent_id', '!=', '0')->orderBy('parent_id', 'ASC')->get();

        return Inertia::render('Calculator', [
            'factors' => $factors,
            'projects' => $projects,
            'categories' => $categories,
        ]);
    }
    public function SAG()
    {

        $projects = Project::all();
        $history_statues = History_statue::all();

        $formatted_categories = array();
        $categories = Category::where('parent_id', '!=', 0)->orderBy('parent_id', 'ASC')->get();

        foreach ($categories as $cat_key => $category) {
            $parents = $category->parent()->get();

            $formatted_categories[$cat_key]['id']                = $category->id;
            $formatted_categories[$cat_key]['name']              = $category->name;
            $formatted_categories[$cat_key]['description']       = $category->description;

            if (!$parents->isEmpty()) {
                $formatted_categories[$cat_key]['parent_id']    = $parents[0]->id;
                $formatted_categories[$cat_key]['parent_name']  = $parents[0]->name;
            }

            $services = Service::where('category_id', '=', $category->id)->get();

            $formatted_categories[$cat_key]['services'] = array();
            foreach ($services as $serv_key => $service) {

                array_push($formatted_categories[$cat_key]['services'], array(
                    'id' => $service->id,
                    'name'         => $service->name,
                    'description'  => $service->description,
                    'qty'          => 0,
                    'actual'       => 0,
                    'gap'          => 0,
                    'saved'        => 0
                ));
            }
        }

        return Inertia::render('SAG', [
            'projects' => $projects,
            'history_statues' => $history_statues,
            'categories' => $formatted_categories,

        ]);
    }

    public function settings()
    {

        $projects = Project::all();
        $factors = Factor::all();
        $categories = Category::all();
        $history_statues = History_statue::all();
        $child_categories = Category::where('parent_id', '!=', '0')->get();


        $services_categories = Category::where('parent_id', '!=', '0')->get();


        $services = DB::table('services')
            ->select('services.*', 'categories.name as category_name')
            ->join('categories', 'categories.id', 'services.category_id')
            ->get();

        $formatted_categories =  array();
        // $formatted_services =  array();

        foreach ($categories as $cat_key => $category) {

            $parents = $category->parent()->get();
            $formatted_categories[$cat_key]['id']              = $category->id;
            $formatted_categories[$cat_key]['name']            = $category->name;
            $formatted_categories[$cat_key]['description']     = $category->description;
            $formatted_categories[$cat_key]['qty']     = 0;
            $formatted_categories[$cat_key]['occup_hour']     = 0;
            $formatted_categories[$cat_key]['price']     = 0;
            $formatted_categories[$cat_key]['total']     = 0;
            $formatted_categories[$cat_key]['profit_margin_p_c']     = 0;
            $formatted_categories[$cat_key]['total_plus_margin']     = 0;

            if (!$parents->isEmpty()) {
                $formatted_categories[$cat_key]['parent_id'] = $parents[0]->id;
                $formatted_categories[$cat_key]['parent_name'] = $parents[0]->name;

                $category_services = $category->services()->get();

                foreach ($category_services as $serv_key => $service) {
                    $formatted_categories[$cat_key]['services'][$serv_key]['id']                = $service->id;
                    $formatted_categories[$cat_key]['services'][$serv_key]['name']              = $service->name;
                    $formatted_categories[$cat_key]['services'][$serv_key]['description']       = $service->description;
                    $formatted_categories[$cat_key]['services'][$serv_key]['unit_measure']      = $service->unit_measure;
                    $formatted_categories[$cat_key]['services'][$serv_key]['qty']               = $service->qty;
                    $formatted_categories[$cat_key]['services'][$serv_key]['percent_imputed']   = $service->percent_imputed;
                    $formatted_categories[$cat_key]['services'][$serv_key]['occup_hour']        = $service->occup_hour;
                    $formatted_categories[$cat_key]['services'][$serv_key]['price']             = $service->price;
                    $formatted_categories[$cat_key]['services'][$serv_key]['total']             = $service->total;
                    $formatted_categories[$cat_key]['services'][$serv_key]['profit_margin_p_c'] = $service->profit_margin_p_c;
                    $formatted_categories[$cat_key]['services'][$serv_key]['total_plus_margin'] = $service->total_plus_margin;
                    $formatted_categories[$cat_key]['services'][$serv_key]['saved']             = 0;
                }
            }
        }


        foreach ($categories as $cat_key => &$category) {
            $parents = $category->parent()->get();
            if (!$parents->isEmpty()) {
                $category['parent_name'] = $parents[0]->name;
            }
        }

        // foreach ($services as $key => $service) {
        //     $category = $service->categories()->get();
        //     $formatted_services[$key]['id']                = $service->id;
        //     $formatted_services[$key]['name']              = $service->name;
        //     $formatted_services[$key]['description']       = $service->description;
        //     $formatted_services[$key]['unit_measure']      = $service->unit_measure;
        //     $formatted_services[$key]['qty']               = $service->qty;
        //     $formatted_services[$key]['occup_hour']        = $service->occup_hour;
        //     $formatted_services[$key]['price']             = $service->price;
        //     $formatted_services[$key]['profit_margin_p_c'] = $service->profit_margin_p_c;

        //     if (!$category->isEmpty()) {
        //         $formatted_services[$key]['category_name'] = $category[0]->name;
        //     }
        // }


        // foreach ($services->items as $key => $service) {
        //     $category = $service->categories()->get(); 
        //     if (!$category->isEmpty()) {
        //         $service[$key]['category_name'] = $category[0]->name;
        //     }
        // }

        return Inertia::render('Settings', [
            'factors' => $factors,
            'projects' => $projects,
            'history_statues' => $history_statues,
            'categories' => $categories,
            'formattedCategories' => $formatted_categories,
            'services' => $services,
            // 'formattedServices' => $formatted_services,
            'ChildCategories' => $child_categories,
        ]);
    }

    public function mapView()
    {
        // $project = Project::findOrFail(1);
        // $category = Category::findOrFail(2);

        $projects = Project::all();
        // $projects[0] = Project::findOrFail(1);
        // dd( $projects);

        foreach ($projects as $key => $project) {

            $projects[$key]['sag'] = UtilityController::sag_values($project);
            $projects[$key]['main_oeuvre'] = DB::table('projects')
                ->join('sag_resources', 'projects.id', '=', 'sag_resources.project_id')
                ->Join('services', 'sag_resources.resource_id', '=', 'services.id')
                ->Join('categories', 'services.category_id', '=', 'categories.id')
                ->where('categories.id',  '=', 2)
                ->where('projects.id',  '=', $project->id)
                ->select('services.*','sag_resources.*', 'categories.name as category_name', 'projects.id')
                ->get()
                ->toArray();
        }

        // dd($projects);
        return Inertia::render('mapView', [
            'projects' => $projects,
            // 'mainOeuvre' => $category->services()->get(),
            // 'project' => $project,
            // 'sag' => UtilityController::sag_values($project),
        ]);
    }

    public function neveling()
    {

        return Inertia::render('Neveling', [
            'projects' => [],
        ]);
    }
}
