<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\PieChartWidget;

class CategoriesPieChart extends PieChartWidget
{
  protected static ?string $heading = 'Kategórie podľa stavu';
  protected static ?int $sort = 2;
  protected int | string | array $columnSpan = ['md' => 6, 'xl' => 6];
  protected static ?string $maxHeight = '300px';

  protected function getData(): array
  {
    $activeCategories = Category::where('is_active', true)->count();
    $inactiveCategories = Category::where('is_active', false)->count();

    return [
      'datasets' => [
        [
          'label' => 'Kategórie',
          'data' => [$activeCategories, $inactiveCategories],
          'backgroundColor' => ['#4CAF50', '#FF9800'],
        ],
      ],
      'labels' => ['Aktívne kategórie', 'Neaktívne kategórie'],
    ];
  }

  protected function getType(): string
  {
    return 'pie';
  }

  protected function getOptions(): array
  {
    return [
      'plugins' => [
        'legend' => [
          'display' => true,
          'position' => 'top',
        ],
      ],
      'scales' => [
        'x' => [
          'display' => false,
        ],
        'y' => [
          'display' => false,
        ],
      ],
    ];
  }
}
