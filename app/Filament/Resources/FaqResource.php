<?php
namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                
            \Filament\Schemas\Components\Grid::make(2)->schema([
                \Filament\Forms\Components\TextInput::make('question_ar')->required(),
                \Filament\Forms\Components\TextInput::make('question_en')->required(),
                \Filament\Forms\Components\Textarea::make('answer_ar')->required()->columnSpanFull(),
                \Filament\Forms\Components\Textarea::make('answer_en')->required()->columnSpanFull(),
                \Filament\Forms\Components\TextInput::make('category'),
                \Filament\Forms\Components\Select::make('product_id')
                    ->relationship('product', 'title_ar')
                    ->searchable()
                    ->nullable(),
                \Filament\Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                \Filament\Forms\Components\Toggle::make('is_active')->default(true),
            ])
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\TextColumn::make('question_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('category')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('product.title_ar')->searchable(),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
