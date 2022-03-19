<?php

namespace App\Charts;

use App\Http\Controllers\UtilityController;
use App\Models\Project;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ResourcesCategoriesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function buildBarChart(Project $project): array
    {
        $addDataArray = array();
        $addDataArray2 = array();
        $setXAxis = array();

        $project_categories_values = UtilityController::project_categories_values($project);

        foreach ($project_categories_values as $key => $categories_values) {
            $setXAxis[] = $categories_values['name'];
            $addDataArray[] = $categories_values['total_plus_margin'] ?? 0;
            $addDataArray2[] = $categories_values['qty'] ?? 0;
        }

        $chart = $this->chart->barChart()
            ->setTitle('Resources\'s Categories Prices & Quantities')
            ->setSubtitle($project->description)
            ->addData('Total price', $addDataArray)
            ->addData('Quantity', $addDataArray2)
            ->setXAxis($setXAxis)
            ->toVue();

        return $chart;
    }


    public function buildPieChart(Project $project): array
    {
        $setLabelsArray = array();
        $addDataArray = array();

        $project_categories_values = UtilityController::project_categories_values($project);

        foreach ($project_categories_values as $key => $categories_values) {
            $setLabelsArray[] = $categories_values['name'];
            $addDataArray[] = $categories_values['total_plus_margin'] ?? 0;
        }

        $chart = $this->chart->pieChart()
            ->setTitle('Resources\'s Categories Prices')
            ->addData($addDataArray)
            ->setColors(['#ffc63b', '#ff6384', '#ff9384', '#ff6744', '#f46984'])
            ->setLabels($setLabelsArray)
            ->toVue();

        return $chart;
    }
}
