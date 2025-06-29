<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\PieChartWidget;

class ProductsPieChart extends PieChartWidget
{
  protected static ?string $heading = 'Produkty podľa stavu';
  protected static ?int $sort = 1;
  protected int | string | array $columnSpan = ['md' => 6, 'xl' => 6];
  protected static ?string $maxHeight = '300px';

  protected function getData(): array
  {
    $activeProducts = Product::where('is_active', true)->count();
    $inactiveProducts = Product::where('is_active', false)->count();

    return [
      'datasets' => [
        [
          'label' => 'Produkty',
          'data' => [$activeProducts, $inactiveProducts],
          'backgroundColor' => ['#36A2EB', '#FF6384'],
        ],
      ],
      'labels' => ['Aktívne produkty', 'Neaktívne produkty'],
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
