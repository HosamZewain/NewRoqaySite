<?php
namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                
            \Filament\Schemas\Components\Grid::make(2)->schema([
                \Filament\Forms\Components\TextInput::make('client_name_ar')->required(),
                \Filament\Forms\Components\TextInput::make('client_name_en')->required(),
                \Filament\Forms\Components\TextInput::make('company_ar'),
                \Filament\Forms\Components\TextInput::make('company_en'),
                \Filament\Forms\Components\TextInput::make('position_ar'),
                \Filament\Forms\Components\TextInput::make('position_en'),
                \Filament\Forms\Components\Textarea::make('review_ar')->required()->columnSpanFull(),
                \Filament\Forms\Components\Textarea::make('review_en')->required()->columnSpanFull(),
                \Filament\Forms\Components\FileUpload::make('image')->image()->disk('public')->directory('testimonials')->columnSpanFull(),
                \Filament\Forms\Components\Select::make('rating')
                    ->options([1=>'1 Star', 2=>'2 Stars', 3=>'3 Stars', 4=>'4 Stars', 5=>'5 Stars'])
                    ->default(5)
                    ->required(),
                \Filament\Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                \Filament\Forms\Components\Toggle::make('is_active')->default(true),
            ])
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\ImageColumn::make('image'),
            \Filament\Tables\Columns\TextColumn::make('client_name_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('company_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('rating')->sortable(),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
