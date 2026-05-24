<?php
namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                
            \Filament\Schemas\Components\Grid::make(2)->schema([
                \Filament\Forms\Components\TextInput::make('key')->required()->unique(ignoreRecord: true),
                \Filament\Forms\Components\Select::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Social',
                        'seo' => 'SEO',
                        'scripts' => 'Scripts',
                        'footer' => 'Footer',
                    ])->required()->default('general'),
                \Filament\Forms\Components\Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                        'boolean' => 'Boolean',
                        'json' => 'JSON',
                    ])->required()->default('text'),
                \Filament\Forms\Components\Textarea::make('value')->columnSpanFull(),
            ])
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\TextColumn::make('key')->searchable(),
            \Filament\Tables\Columns\BadgeColumn::make('group')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('type'),
            \Filament\Tables\Columns\TextColumn::make('value')->limit(50),
            \Filament\Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
        
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
