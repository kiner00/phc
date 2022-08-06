<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Order;
use App\Models\PurchaseOrder;
use App\Models\Platform;
use App\Models\Product;
use Carbon\Carbon;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Dashboard extends Component
{
    public function render()
    {
        $todaySales = Order::whereDate('created_at', Carbon::today())->sum('total');
        $weeklySales = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total');
        $monthlySales = Order::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('total');
        $montlyPo = PurchaseOrder::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('total_cost');

        $recentSaleTable = Order::orderBy('created_at', 'desc')->limit(10)->get();

        $columnChartModel = (new ColumnChartModel())->setTitle('Today Sales By Platform');
        $columnChartModelStocks = (new ColumnChartModel())->setTitle('Remaining Stocks');

        $platforms = Platform::get();
        foreach($platforms as $platform){
            $platformName = $platform->platform;
            $platformTotal = Order::whereDate('created_at', Carbon::today())->where('platform_id', $platform->id)->sum('total');
            $columnChartModel->addColumn($platformName, $platformTotal, '#90cdf4');
        }
        
        $products = Product::get();
        foreach($products as $product){
            $productName = $product->name;
            $productStocks = $product->stocks;
            $columnChartModelStocks->addColumn($productName, $productStocks, '#90cdf4');
        }
        
        return view('livewire.dashboard.dashboard', [
            'todaySales' => $todaySales,
            'weeklySales' => $weeklySales,
            'monthlySales' => $monthlySales,
            'monthlyPo' => $montlyPo,
            'recentSaleTable' => $recentSaleTable,
            'columnChartModel' => $columnChartModel,
            'columnChartModelStocks' => $columnChartModelStocks
        ]);
    }
}
