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
            'categories' =>  UtilityController::categories_values($project),
            'project' =>  UtilityController::project_calculation($project),
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
            'sag' =>  UtilityController::sag_values($project),
            'project' =>  UtilityController::project_calculation($project),
        ];

        $pdf = PDF::loadView('SAG', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('Arbeitsstunden1');
        return $pdf->download('Nicesnippets1.pdf');
    }
    
    public function categories_values(Project $project)
    {
        return UtilityController::project_categories_resources_values($project);
    }
}
