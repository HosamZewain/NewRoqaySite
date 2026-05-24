<?php
namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Leads', Lead::count())
                ->description('All time')
                ->color('primary'),
            Stat::make('New Leads', Lead::where('status', 'new')->count())
                ->description('Awaiting contact')
                ->color('warning'),
            Stat::make('Products', Product::count())
                ->color('success'),
            Stat::make('Services', Service::count())
                ->color('info'),
            Stat::make('Blog Posts', BlogPost::where('status', 'published')->count())
                ->color('gray'),
        ];
    }
}
