<?php

namespace App\Http\Controllers;

use Blumilk\Heatmap\Decorators\TailwindDecorator;
use Blumilk\Heatmap\PeriodInterval;
use Blumilk\LaravelHeatmap\LaravelHeatmapBuilder;
use App\Models\testModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class test extends Controller
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
            decorator: new TailwindDecorator("green"),
            alignedToStartOfPeriod: true,
            alignedToEndOfPeriod: false,
        );

        $startOfWeek = Carbon::now()->subWeek()->timestamp;
        $endOfWeek = Carbon::now()->timestamp;

        $query = testModel::query()
            ->where('created_at', '>=', $startOfWeek)
            ->where('created_at', '<=', $endOfWeek);

        $results = $query->get();

        $results->transform(function ($item) {
            $item->created_at = Carbon::parse($item->created_at)->timestamp;
            return $item;
        });

        $results = $builder->buildFromQuery($query);

        return view('test', ['result' => $results]);
    }
}
