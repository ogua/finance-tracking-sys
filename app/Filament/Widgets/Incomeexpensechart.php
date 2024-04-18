<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Income;
use Filament\Widgets\ChartWidget;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\DB;

class Incomeexpensechart extends ApexChartWidget
{
    protected static ?string $heading = 'Income Expenses';
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 2;
    
    /**
    * Chart Id
    */
    protected static ?string $chartId = 'revenueChart';
    
    /**
    * Widget content height
    */
    protected static ?int $contentHeight = 275;
    
    /**
    * Chart options (series, labels, types, size, animations...)
    * https://apexcharts.com/docs/options
    */
    protected function getOptions(): array
    {
        $income = Income::pluck('amount')->toArray();
        $expense = Expense::pluck('amount')->toArray();
        
        $monthsArray = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        
        // Query to get total amount grouped by month
        $income = DB::table('incomes')
        ->select(DB::raw('MONTH(transaction_date) as month'), DB::raw('SUM(amount) as total_amount'))
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->get();
        
        // Create an associative array with month as key and total amount as value
        $incomeArray = [];
        foreach ($income as $item) {
            $incomeArray[$item->month] = $item->total_amount;
        }
        
        // Merge the income array with the months array, filling in missing months with 0
        $result = [];
        foreach ($monthsArray as $index => $month) {
            $result[$month] = $incomeArray[$index + 1] ?? 0;
        }
        
        $totalAmounts = array_values($result);
        
        
        // Query to get total amount grouped by month
        $expense = DB::table('expenses')
        ->select(DB::raw('MONTH(transaction_date) as month'), DB::raw('SUM(amount) as total_amount'))
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->get();
        
        // Create an associative array with month as key and total amount as value
        $expenseArray = [];
        foreach ($expense as $item) {
            $expenseArray[$item->month] = $item->total_amount;
        }
        
        // Merge the income array with the months array, filling in missing months with 0
        $eresult = [];
        foreach ($monthsArray as $index => $month) {
            $eresult[$month] = $expenseArray[$index + 1] ?? 0;
        }
        
        $totalexpenses = array_values($eresult);
        
        
        
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 260,
                'parentHeightOffset' => 2,
                'stacked' => true,
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'series' => [
                [
                    'name' => 'Income',
                    'data' => $totalAmounts,
                ],
                [
                    'name' => 'Expense',
                    'data' => $totalexpenses,
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'columnWidth' => '50%',
                ],
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'legend' => [
                'show' => true,
                'horizontalAlign' => 'right',
                'position' => 'top',
                'fontFamily' => 'inherit',
                'markers' => [
                    'height' => 12,
                    'width' => 12,
                    'radius' => 12,
                    'offsetX' => -3,
                    'offsetY' => 2,
                ],
                'itemMargin' => [
                    'horizontal' => 5,
                ],
            ],
            'grid' => [
                'show' => false,
                
            ],
            'xaxis' => [
                'categories' => [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
                ],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
                'axisTicks' => [
                    'show' => false,
                ],
                'axisBorder' => [
                    'show' => false,
                ],
            ],
            'yaxis' => [
                'offsetX' => -16,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
                'min' => -200,
                'max' => 300,
                'tickAmount' => 5,
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shade' => 'dark',
                    'type' => 'vertical',
                    'shadeIntensity' => 0.5,
                    'gradientToColors' => ['#d97706', '#c2410c'],
                    'opacityFrom' => 1,
                    'opacityTo' => 1,
                    'stops' => [0, 100],
                ],
            ],
            'stroke' => [
                'curve' => 'smooth',
                'width' => 1,
                'lineCap' => 'round',
            ],
            'colors' => ['#f59e0b', '#ea580c'],
        ];
    }
    
    protected function extraJsOptions(): ?RawJs
    {
        return RawJs::make(<<<'JS'
        {
            xaxis: {
                labels: {
                    formatter: function (val, timestamp, opts) {
                        return val
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (val, index) {
                        return '$' + val
                    }
                }
            },
            tooltip: {
                x: {
                    formatter: function (val) {
                        return val + ' /23'
                    }
                }
            }
        }
        JS);
    }
}
