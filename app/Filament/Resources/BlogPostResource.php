<?php
namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;
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
                            \Filament\Forms\Components\Textarea::make('excerpt_ar'),
                            \Filament\Forms\Components\RichEditor::make('content_ar')->required(),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title_en')->required(),
                            \Filament\Forms\Components\TextInput::make('slug_en')->required(),
                            \Filament\Forms\Components\Textarea::make('excerpt_en'),
                            \Filament\Forms\Components\RichEditor::make('content_en')->required(),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Media')
                        ->schema([
                            \Filament\Forms\Components\FileUpload::make('featured_image')->image()->disk('public')->directory('blog'),
                            \Filament\Forms\Components\FileUpload::make('og_image')->image()->disk('public')->directory('seo'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('SEO')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('seo_title_ar'),
                            \Filament\Forms\Components\Textarea::make('seo_description_ar'),
                            \Filament\Forms\Components\TextInput::make('seo_title_en'),
                            \Filament\Forms\Components\Textarea::make('seo_description_en'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('author_name'),
                            \Filament\Forms\Components\TextInput::make('category'),
                            \Filament\Forms\Components\Select::make('status')
                                ->options(['draft' => 'Draft', 'published' => 'Published'])
                                ->default('draft')
                                ->required(),
                            \Filament\Forms\Components\DateTimePicker::make('published_at'),
                        ]),
                ])->columnSpanFull()
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\ImageColumn::make('featured_image'),
            \Filament\Tables\Columns\TextColumn::make('title_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('category')->searchable(),
            \Filament\Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'gray' => 'draft',
                    'success' => 'published',
                ]),
            \Filament\Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
        
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
