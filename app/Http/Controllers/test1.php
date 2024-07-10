<?php

namespace App\Http\Controllers;

use Blumilk\Heatmap\Decorators\TailwindDecorator;
use Blumilk\Heatmap\PeriodInterval;
use Blumilk\LaravelHeatmap\LaravelHeatmapBuilder;
use App\Models\testModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\File;


class test1 extends Controller
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
            decorator: new TailwindDecorator("blue"),
            alignedToStartOfPeriod: true,
            alignedToEndOfPeriod: false,
        );

        $filePath = base_path('app/Http/Controllers/data.json');
        $jsonData = File::get($filePath);
        $data = json_decode($jsonData, true);

        $results = $builder->buildFromArray($data);

        return view('test', ['result' => $results]);
    }
}
