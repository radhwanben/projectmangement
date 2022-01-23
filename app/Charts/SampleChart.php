<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Project;
use App\Models\Tache;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $users =User::all()->toJson();
        $projects =Project::all()->toJson();
        $taches =Tache::all()->toJson();
        return Chartisan::build()
            ->labels(['Users', 'Projects', 'Taches'])
            ->dataset($users, [1, 0, 0])
            ->dataset($projects, [0, 1, 0])
            ->dataset($taches, [0, 0, 1]);
    }
}