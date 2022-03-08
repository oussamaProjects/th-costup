<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfGenerateController extends Controller
{
    public function dac(Project $project)
    {
        //  dd($_categories);
        $data = [
            'title' => 'NiceSnippets Blog',
            'categories' =>  $this->categories_values($project),
            'project' =>  $this->project_values($project),
            'factors' => $project->factors()->get(),
        ];

        $pdf = PDF::loadView('myPDF', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('Arbeitsstunden');
        return $pdf->download('Nicesnippets.pdf');
    }


    public function sag(Project $project)
    {
        //  dd($_categories);
        $data = [
            'title' => 'Standard Actual Gap',
            'sag' =>  $this->sag_values($project),
            'project' =>  $this->project_values($project), 
        ];

        $pdf = PDF::loadView('SAG', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('Arbeitsstunden1');
        return $pdf->download('Nicesnippets1.pdf');
    }


    public function sag_values(Project $project)
    {

        $_categories = array();
        $count = 0;

        $categories = Category::where('parent_id', '!=', '0')->orderBy('parent_id', 'ASC')->get();
        // dd($_categories);

        foreach ($categories as $cat_key => $category) {
            $count = 0;

            $parents = $category->parent()->get();

            $_categories[$cat_key]['id']                = $category->id;
            $_categories[$cat_key]['name']              = $category->name;
            $_categories[$cat_key]['description']       = $category->description;

            $category_values = DB::table('projects')
                ->select('categories.*', 'sag_categories.*')
                ->join('sag_categories', 'sag_categories.project_id', 'projects.id')
                ->rightJoin('categories', 'categories.id', 'sag_categories.category_id')
                ->where('projects.id', '=', $project->id)
                ->where('categories.id', '=', $category->id)
                ->distinct()
                ->get();

            if (!$category_values->isEmpty()) {
                $_categories[$cat_key]['qty']               = $category_values[0]->qty;
                $_categories[$cat_key]['actual']            = $category_values[0]->actual;
                $_categories[$cat_key]['gap']               = $category_values[0]->gap;
            }

            if (!$parents->isEmpty()) {
                $_categories[$cat_key]['parent_id']    = $parents[0]->id;
                $_categories[$cat_key]['parent_name']  = $parents[0]->name;
            }

            $services = Service::where('category_id', '=', $category->id)->get();

            $_categories[$cat_key]['services'] = array();

            foreach ($services as $serv_key => $service) {
                $count += $services->count();

                $_categories[$cat_key]['count_parent'] = $count;

                $services_values = DB::table('projects')
                    ->select('sag_resources.*')
                    ->join('sag_resources', 'sag_resources.project_id', 'projects.id')
                    ->join('services', 'services.id', 'sag_resources.resource_id')
                    ->where('projects.id', '=', $project->id)
                    ->where('services.id', '=', $service->id)
                    ->distinct()
                    ->get();

                if (!$services_values->isEmpty()) {

                    array_push($_categories[$cat_key]['services'], array(
                        'id' => $service->id,
                        'name'         => $service->name,
                        'description'  => $service->description,
                        'qty'          => $services_values[0]->qty,
                        'actual'       => $services_values[0]->actual,
                        'gap'          => $services_values[0]->gap,
                        'saved'        => 1
                    ));
                }
            }
        }

        return $_categories;
    }


    public function categories_values(Project $project)
    {

        $_categories = array();
        $count = 0;

        $categories = Category::where('parent_id', '!=', '0')->orderBy('parent_id', 'ASC')->get();
        // dd($_categories);

        foreach ($categories as $cat_key => $category) {
            $count = 0;

            $parents = $category->parent()->get();

            $_categories[$cat_key]['id']                = $category->id;
            $_categories[$cat_key]['name']              = $category->name;
            $_categories[$cat_key]['description']       = $category->description;

            $category_values = DB::table('projects')
                ->select('categories.*', 'projects_categories.*')
                ->join('projects_categories', 'projects_categories.project_id', 'projects.id')
                ->rightJoin('categories', 'categories.id', 'projects_categories.category_id')
                ->where('projects.id', '=', $project->id)
                ->where('categories.id', '=', $category->id)
                ->distinct()
                ->get();

            if (!$category_values->isEmpty()) {
                $_categories[$cat_key]['qty']               = $category_values[0]->qty;
                $_categories[$cat_key]['occup_hour']        = $category_values[0]->occup_hour;
                $_categories[$cat_key]['price']             = $category_values[0]->price;
                $_categories[$cat_key]['total']             = $category_values[0]->total;
                $_categories[$cat_key]['profit_margin_p_c'] = $category_values[0]->profit_margin_p_c;
                $_categories[$cat_key]['total_plus_margin'] = $category_values[0]->total_plus_margin;
            }

            if (!$parents->isEmpty()) {
                $_categories[$cat_key]['parent_id']    = $parents[0]->id;
                $_categories[$cat_key]['parent_name']  = $parents[0]->name;
            }

            $services = Service::where('category_id', '=', $category->id)->get();

            $_categories[$cat_key]['services'] = array();

            foreach ($services as $serv_key => $service) {
                $count += $services->count();
                // echo '<br>services->count '. $services->count();
                // echo '<br>count '. $count;
                $_categories[$cat_key]['count_parent'] = $count;

                $services_values = DB::table('projects')
                    ->select('projects_services.*')
                    ->join('projects_services', 'projects_services.project_id', 'projects.id')
                    ->join('services', 'services.id', 'projects_services.service_id')
                    ->where('projects.id', '=', $project->id)
                    ->where('services.id', '=', $service->id)
                    ->distinct()
                    ->get();

                if (!$services_values->isEmpty()) {

                    array_push($_categories[$cat_key]['services'], array(
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

        return $_categories;
    }

    public function project_values(Project $project)
    {
        return UtilityController::project_calculation($project);
    }
}
