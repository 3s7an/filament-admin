<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ProductsPieChart;
use App\Filament\Widgets\CategoriesPieChart;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            ProductsPieChart::class,
            CategoriesPieChart::class,
        ];
    }
}