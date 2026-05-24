<?php
namespace App\Filament\Resources;

use App\Filament\Resources\HomepageSectionResource\Pages;
use App\Models\HomepageSection;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomepageSectionResource extends Resource
{
    protected static ?string $model = HomepageSection::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                
            \Filament\Schemas\Components\Tabs::make('Tabs')
                ->tabs([
                    \Filament\Schemas\Components\Tabs\Tab::make('General')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('section_key')->required()->disabledOn('edit'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Arabic Content')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title_ar'),
                            \Filament\Forms\Components\Textarea::make('subtitle_ar'),
                            \Filament\Forms\Components\RichEditor::make('content_ar'),
                            \Filament\Forms\Components\TextInput::make('button_text_ar'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title_en'),
                            \Filament\Forms\Components\Textarea::make('subtitle_en'),
                            \Filament\Forms\Components\RichEditor::make('content_en'),
                            \Filament\Forms\Components\TextInput::make('button_text_en'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Media')
                        ->schema([
                            \Filament\Forms\Components\FileUpload::make('image')->image()->directory('sections'),
                            \Filament\Forms\Components\FileUpload::make('background_image')->image()->directory('sections'),
                            \Filament\Forms\Components\TextInput::make('button_url'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Extra Data')
                        ->schema([
                            \Filament\Forms\Components\Textarea::make('extra_data')
                                ->afterStateHydrated(function (\Filament\Forms\Components\Textarea $component, $state) {
                                    $component->state(is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $state);
                                })
                                ->dehydrateStateUsing(fn ($state) => is_string($state) && !empty($state) ? json_decode($state, true) : null)
                                ->rows(10),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                            \Filament\Forms\Components\Toggle::make('is_active')->default(true),
                        ]),
                ])->columnSpanFull()
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\TextColumn::make('section_key')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('title_ar')->searchable(),
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
            'index' => Pages\ListHomepageSections::route('/'),
            'create' => Pages\CreateHomepageSection::route('/create'),
            'edit' => Pages\EditHomepageSection::route('/{record}/edit'),
        ];
    }
}
