<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Project;

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
        $factorsPercent = 0;
        $_i = 0;

        if (!$categories_values->isEmpty()) {

            $projectFactors = $project->factors()->get();

            foreach ($projectFactors as $key => $factor) {
                $_i++;
                $factorTotal += $factor->value;
            }
            if ($_i != 0)
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

            $epo = $total_plus_margin;
            $epps = ($epo * $factorsPercent / 100) + ($epo) + $epo;
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