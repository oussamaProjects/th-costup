<?php

namespace App\Charts;

use App\Models\Project;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyProjectsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function buildPieChart(): array
    {

        $projects = Project::all();
        $addDataArray = array();
        $setLabelsArray = array();

        foreach ($projects as $key => $project) {
            $addDataArray[] = $project->epp;
            $setLabelsArray[] = $project->name;
        }

        $chart = $this->chart->pieChart()
            ->setTitle('Resources')
            ->addData($addDataArray)
            ->setColors(['#ffc63b', '#ff6384', '#ff9384', '#ff6744', '#f46984'])
            ->setLabels($setLabelsArray)
            ->toVue();

        return $chart;
    }

    public function buildAreaChart(): array
    {

        $projects  = Project::all();
        $addDataArray = array();
        $setLabelsArray = array();

        foreach ($projects as $key => $project) {
            $addDataArray[] = $project->epp;
            $setLabelsArray[] = $project->name;
        }

        $chart = $this->chart->areaChart()
            ->setTitle('Monthly Users')
            ->addArea('Active users', [10, 30, 25, 15, 13, 19, 9, 8, 30, 25, 20, 40])
            ->addArea('Inactive users', [5, 15, 35, 25, 20, 40, 50, 12, 7, 15, 13, 19])
            ->setColors(['#ffc63b', '#ff6384', '#ff9384', '#ff6744', '#f46484', '#ff9874', '#f46184'])
            ->toVue();

        return $chart;
    }
}
