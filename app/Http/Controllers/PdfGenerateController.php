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
    public function PDFgenerate(Project $project)
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


    public function categories_values(Project $project){

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
                echo '<br>services->count '. $services->count();
                echo '<br>count '. $count;
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

        $categories_values = DB::table('projects')
            ->select('projects_categories.*')
            ->join('projects_categories', 'projects_categories.project_id', 'projects.id')
            ->join('categories', 'categories.id', 'projects_categories.category_id')
            ->where('projects.id', '=', $project->id)
            ->distinct()
            ->get();

        if (!$categories_values->isEmpty()) {

            $qty = 0;
            $occup_hour = 0;
            $price = 0;
            $total = 0;
            $profit_margin_p_c = 0;
            $total_plus_margin = 0;

            foreach ($categories_values as $key => $value) {
                $qty += $value->qty;
                $occup_hour += $value->occup_hour;
                $price += $value->price;
                $total += $value->total;
                $profit_margin_p_c += 0;
                $total_plus_margin += $value->total_plus_margin;
            }

            $epo = $total_plus_margin;
            $epps = ($epo * 0.06) + ($epo * 0.05) + $epo;
            $epp = ($epo + $epps) / 2;
            $em = ((1 * $epo) + (4 * $epp) + (1 * $epps)) / 6;
            $smph = ($em * 1) / 4;
            $lmph = ($em * 1) / 4;

            $project->epo = $epo;
            $project->epp = $epp;
            $project->epps = $epps;
            $project->em = $em;
            $project->smph = $smph;
            $project->lmph = $lmph;
            $project->save();
        }

        return $project;
    }
}
