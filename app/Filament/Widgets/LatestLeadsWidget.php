<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestLeadsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Lead::query()->latest()->take(5))
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('interested_product'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'info' => 'new',
                        'warning' => 'contacted',
                        'success' => 'qualified',
                        'gray' => 'closed',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->paginated(false);
    }
}
