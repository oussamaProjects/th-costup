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
    public function categories_values(Project $project)
    {
        return UtilityController::project_categories_resources_values($project);
    }

    public function project_values(Project $project)
    {
        return UtilityController::project_calculation($project);
    }
}
