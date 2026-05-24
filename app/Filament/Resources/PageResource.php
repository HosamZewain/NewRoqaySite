<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                
            \Filament\Schemas\Components\Tabs::make('Tabs')
                ->tabs([
                    \Filament\Schemas\Components\Tabs\Tab::make('Arabic Content')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title_ar')->required(),
                            \Filament\Forms\Components\TextInput::make('slug_ar')->required(),
                            \Filament\Forms\Components\RichEditor::make('content_ar')->required(),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title_en')->required(),
                            \Filament\Forms\Components\TextInput::make('slug_en')->required(),
                            \Filament\Forms\Components\RichEditor::make('content_en')->required(),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Media')
                        ->schema([
                            \Filament\Forms\Components\FileUpload::make('featured_image')->image()->directory('pages'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('SEO Arabic')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('seo_title_ar'),
                            \Filament\Forms\Components\Textarea::make('seo_description_ar'),
                            \Filament\Forms\Components\TextInput::make('seo_keywords_ar'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('SEO English')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('seo_title_en'),
                            \Filament\Forms\Components\Textarea::make('seo_description_en'),
                            \Filament\Forms\Components\TextInput::make('seo_keywords_en'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            \Filament\Forms\Components\Toggle::make('is_active')->default(true),
                        ]),
                ])->columnSpanFull()
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\TextColumn::make('title_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('slug_ar')->searchable(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
