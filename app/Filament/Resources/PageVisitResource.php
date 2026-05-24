<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageVisitResource\Pages;
use App\Models\PageVisit;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PageVisitResource extends Resource
{
    protected static ?string $model = PageVisit::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Visits';

    protected static ?string $modelLabel = 'Page visit';

    protected static ?string $pluralModelLabel = 'Visits';

    // Surface "Visits" near the top of the sidebar
    protected static ?int $navigationSort = 1;

    public static function form(Schema $form): Schema
    {
        // No create/edit UI — rows are populated by the TrackPageVisit middleware.
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('label')
                    ->label('Page')
                    ->searchable()
                    ->wrap(),
                \Filament\Tables\Columns\BadgeColumn::make('locale')
                    ->colors(['primary' => 'ar', 'success' => 'en'])
                    ->formatStateUsing(fn (string $state) => strtoupper($state)),
                \Filament\Tables\Columns\TextColumn::make('visit_count')
                    ->label('Visits')
                    ->numeric()
                    ->sortable()
                    ->alignEnd()
                    ->weight('bold')
                    ->color('primary'),
                \Filament\Tables\Columns\TextColumn::make('last_visited_at')
                    ->label('Last visit')
                    ->dateTime()
                    ->sortable()
                    ->since(),
                \Filament\Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->url(fn (PageVisit $r) => $r->url, true)
                    ->limit(45)
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('page_key')
                    ->label('Key')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('visit_count', 'desc')
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('locale')
                    ->options(['ar' => 'Arabic', 'en' => 'English']),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('reset')
                    ->label('Reset counter')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalDescription('Set the counter for this page back to zero?')
                    ->action(function (PageVisit $record) {
                        $record->update(['visit_count' => 0, 'last_visited_at' => null]);
                        Notification::make()->success()->title('Counter reset')->send();
                    }),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\BulkAction::make('resetSelected')
                        ->label('Reset counters')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $r) {
                                $r->update(['visit_count' => 0, 'last_visited_at' => null]);
                            }
                            Notification::make()->success()->title('Counters reset')->send();
                        }),
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageVisits::route('/'),
        ];
    }

    // No create permission — these rows are populated by middleware only
    public static function canCreate(): bool
    {
        return false;
    }
}
