<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class Expensetrends extends ChartWidget
{
    protected static ?string $heading = 'Expense Trends';
    
    protected static string $color = 'success';
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 3;
    
    
    protected function getData(): array
    {   
        $data = Trend::model(Expense::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
            
            return [
                'datasets' => [
                    [
                        'label' => 'Expense Trends',
                        'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    ],
                ],
                'labels' => $data->map(fn (TrendValue $value) => $value->date),
            ];
        }
        
        protected function getType(): string
        {
            return 'line';
        }
    }
    