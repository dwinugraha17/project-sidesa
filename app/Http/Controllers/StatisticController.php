<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        // Statistik Gender
        $genderStats = Resident::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get();

        // Statistik Dusun
        $dusunStats = Resident::select('dusun', DB::raw('count(*) as total'))
            ->whereNotNull('dusun')
            ->groupBy('dusun')
            ->get();

        // Statistik Agama
        $religionStats = Resident::select('religion', DB::raw('count(*) as total'))
            ->whereNotNull('religion')
            ->groupBy('religion')
            ->get();

        // Statistik Pekerjaan (Top 5)
        $occupationStats = Resident::select('occupation', DB::raw('count(*) as total'))
            ->whereNotNull('occupation')
            ->groupBy('occupation')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('pages.statistic.index', compact('genderStats', 'dusunStats', 'religionStats', 'occupationStats'));
    }
}