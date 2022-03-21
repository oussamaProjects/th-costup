<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyProjectsChart;
use Inertia\Inertia;

class ChartsController extends Controller
{
    public function index(MonthlyProjectsChart $chart)
    {
        return Inertia::render('Charts', ['Chart' => $chart->buildPieChart() ]);
    }
}
