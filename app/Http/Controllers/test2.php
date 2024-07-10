<?php

namespace App\Http\Controllers;

use Blumilk\Heatmap\Decorators\TailwindDecorator;
use Blumilk\Heatmap\PeriodInterval;
use Blumilk\LaravelHeatmap\LaravelHeatmapBuilder;
use App\Models\testModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\File;


class test2 extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $interval = PeriodInterval::Daily;

        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $startOfHour = $now->startOfHour();

        $builder = new LaravelHeatmapBuilder(
            now: $startOfHour,
            periodInterval: $interval,
            period: CarbonPeriod::create($startOfMonth, '1 day', $endOfMonth),
            decorator: new TailwindDecorator("red"),
            alignedToStartOfPeriod: true,
            alignedToEndOfPeriod: false,
        );

        $results = $builder->buildFromCollection(testModel::all(), 'created_at');

        return view('test', ['result' => $results]);
    }
}
