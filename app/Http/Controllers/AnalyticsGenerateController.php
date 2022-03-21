<?php

namespace App\Http\Controllers;

use App\Charts\ResourcesCategoriesChart;
use App\Models\Project;
use Inertia\Inertia;

class AnalyticsGenerateController extends Controller
{
    public function projectAnalytics(Project $project, ResourcesCategoriesChart $chart)
    {
        return Inertia::render('Charts', ['BarChart' => $chart->buildBarChart($project), 'PieChart' => $chart->buildPieChart($project)]);
    }
}
