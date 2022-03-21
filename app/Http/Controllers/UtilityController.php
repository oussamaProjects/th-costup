<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Project;
use App\Models\Service;

class UtilityController extends Controller
{
    static function project_calculation(Project $project)
    {

        $categories_values = DB::table('projects')
            ->select('projects_categories.*')
            ->join('projects_categories', 'projects_categories.project_id', 'projects.id')
            ->join('categories', 'categories.id', 'projects_categories.category_id')
            ->where('projects.id', '=', $project->id)
            ->distinct()
            ->get();

        $factorTotal = 0;
        $factorsPercent = 1;
        $_i = 0;

        $smph_cd = ($project->smph_custommer_demand == 0) ? 1 : $project->smph_custommer_demand;
        $smph_pat = ($project->smph_production_available_time == 0) ? 1 : $project->smph_production_available_time;
        $lmph_cd = ($project->lmph_custommer_demand == 0) ? 1 : $project->lmph_custommer_demand;
        $lmph_pat = ($project->lmph_production_available_time == 0) ? 1 : $project->lmph_production_available_time;

        if (!$categories_values->isEmpty()) {

            $projectFactors = $project->factors()->get();

            foreach ($projectFactors as $key => $factor) {
                $_i++;
                $factorTotal += $factor->value;
            }
            if ($_i != 0 && $factorTotal != 0)
                $factorsPercent = $factorTotal / $_i;

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

            // $epo = $total_plus_margin; 
            $epo = $total_plus_margin + ($total_plus_margin * $factorsPercent / 100);

            $epps = ($epo * $factorsPercent / 100) + ($epo) + $epo;
            $epp = ($epo + $epps) / 2;
            $em = ((1 * $epo) + (4 * $epp) + (1 * $epps)) / 6;
            $smph = ($em * $smph_pat) / $smph_cd;
            $lmph = ($em * $lmph_pat) /  $lmph_cd;

            $project->epo  = $epo;
            $project->epp  = $epp;
            $project->epps = $epps;
            $project->em   = $em;
            $project->smph = $smph;
            $project->lmph = $lmph;

            try {
                $project->epo  = $epo;
                $project->epp  = $epp;
                $project->epps = $epps;
                $project->em   = $em;
                $project->smph = $smph;
                $project->lmph = $lmph;
                $project->save();
            } catch (\Exception $e) {
                // do task when error
                echo $e->getMessage();
            }
        }

        return $project;
    }

    static function project_categories_resources_values(Project $project)
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

    static function project_categories_values(Project $project)
    {

        $categories = Category::where('parent_id', '!=', '0')->orderBy('parent_id', 'ASC')->get();
        $_categories = array();

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
        }

        return $_categories;
    }
    static function sag_values(Project $project)
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
                        'id'                => $services_values[0]->resource_id,
                        'sag_resources_id'  => $services_values[0]->id,
                        'name'              => $service->name,
                        'description'       => $service->description,
                        'qty'               => $services_values[0]->qty,
                        'actual'            => $services_values[0]->actual,
                        'gap'               => $services_values[0]->gap,
                        'saved'             => 1
                    ));
                }
            }
        }

        return $_categories;
    }
}
