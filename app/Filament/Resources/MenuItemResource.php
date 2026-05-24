<?php
namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                
            \Filament\Schemas\Components\Grid::make(2)->schema([
                \Filament\Forms\Components\TextInput::make('label_ar')->required(),
                \Filament\Forms\Components\TextInput::make('label_en')->required(),
                \Filament\Forms\Components\TextInput::make('url_ar')->required(),
                \Filament\Forms\Components\TextInput::make('url_en')->required(),
                \Filament\Forms\Components\Select::make('location')
                    ->options(['header' => 'Header', 'footer' => 'Footer'])
                    ->default('header')
                    ->required(),
                \Filament\Forms\Components\Toggle::make('open_in_new_tab')->default(false),
                \Filament\Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                \Filament\Forms\Components\Toggle::make('is_active')->default(true),
            ])
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\TextColumn::make('label_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('label_en')->searchable(),
            \Filament\Tables\Columns\BadgeColumn::make('location'),
            \Filament\Tables\Columns\TextColumn::make('url_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('sort_order')->sortable(),
            \Filament\Tables\Columns\ToggleColumn::make('is_active'),
        
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
