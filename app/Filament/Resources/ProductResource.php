<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
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
                            \Filament\Forms\Components\Textarea::make('short_description_ar')->required(),
                            \Filament\Forms\Components\RichEditor::make('description_ar')->required(),
                            \Filament\Forms\Components\TextInput::make('hero_headline_ar'),
                            \Filament\Forms\Components\Textarea::make('hero_subheadline_ar'),
                            \Filament\Forms\Components\Textarea::make('target_audience_ar'),
                            \Filament\Forms\Components\Repeater::make('features_ar')
                                ->simple(\Filament\Forms\Components\TextInput::make('feature')->required()),
                            \Filament\Forms\Components\Repeater::make('benefits_ar')
                                ->simple(\Filament\Forms\Components\TextInput::make('benefit')->required()),
                            \Filament\Forms\Components\Repeater::make('modules_ar')
                                ->schema([
                                    \Filament\Forms\Components\TextInput::make('title')->required(),
                                    \Filament\Forms\Components\Textarea::make('description')->required(),
                                    \Filament\Forms\Components\TextInput::make('icon'),
                                ]),
                            \Filament\Forms\Components\Repeater::make('implementation_steps_ar')
                                ->schema([
                                    \Filament\Forms\Components\TextInput::make('title')->required(),
                                    \Filament\Forms\Components\Textarea::make('description')->required(),
                                ]),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title_en')->required(),
                            \Filament\Forms\Components\TextInput::make('slug_en')->required(),
                            \Filament\Forms\Components\Textarea::make('short_description_en')->required(),
                            \Filament\Forms\Components\RichEditor::make('description_en')->required(),
                            \Filament\Forms\Components\TextInput::make('hero_headline_en'),
                            \Filament\Forms\Components\Textarea::make('hero_subheadline_en'),
                            \Filament\Forms\Components\Textarea::make('target_audience_en'),
                            \Filament\Forms\Components\Repeater::make('features_en')
                                ->simple(\Filament\Forms\Components\TextInput::make('feature')->required()),
                            \Filament\Forms\Components\Repeater::make('benefits_en')
                                ->simple(\Filament\Forms\Components\TextInput::make('benefit')->required()),
                            \Filament\Forms\Components\Repeater::make('modules_en')
                                ->schema([
                                    \Filament\Forms\Components\TextInput::make('title')->required(),
                                    \Filament\Forms\Components\Textarea::make('description')->required(),
                                    \Filament\Forms\Components\TextInput::make('icon'),
                                ]),
                            \Filament\Forms\Components\Repeater::make('implementation_steps_en')
                                ->schema([
                                    \Filament\Forms\Components\TextInput::make('title')->required(),
                                    \Filament\Forms\Components\Textarea::make('description')->required(),
                                ]),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Media')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('icon'),
                            \Filament\Forms\Components\FileUpload::make('featured_image')->image()->disk('public')->directory('products'),
                            \Filament\Forms\Components\FileUpload::make('gallery_images')->image()->disk('public')->multiple()->directory('products'),
                            \Filament\Forms\Components\FileUpload::make('og_image')->image()->disk('public')->directory('seo'),
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
                    \Filament\Schemas\Components\Tabs\Tab::make('iRes Screenshots')
                        ->schema(static::iresScreenshotFields())
                        // Show only for the iRes product (matches by slug). New products won't see this tab.
                        ->visible(fn (?Product $record): bool => $record !== null
                            && in_array('ires-system', [$record->slug_ar, $record->slug_en], true)),
                    \Filament\Schemas\Components\Tabs\Tab::make('Pricing')
                        ->schema(static::pricingFields()),
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
                
            \Filament\Tables\Columns\ImageColumn::make('featured_image'),
            \Filament\Tables\Columns\TextColumn::make('title_ar')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('title_en')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('sort_order')->sortable(),
            \Filament\Tables\Columns\ToggleColumn::make('is_active'),
            \Filament\Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    /**
     * Pricing tab fields. Stored as:
     *   pricing_enabled  → boolean column
     *   pricing.{...}    → keys in the pricing JSON column
     *   pricing.packages → array of package rows
     */
    protected static function pricingFields(): array
    {
        return [
            \Filament\Forms\Components\Toggle::make('pricing_enabled')
                ->label('Show pricing section on this product page')
                ->helperText('When off, the section is hidden even if packages are configured.')
                ->default(false)
                ->inline(false),

            \Filament\Schemas\Components\Section::make('Section headers')
                ->schema([
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\TextInput::make('pricing.title_ar')->label('Title (AR)')->placeholder('اختر الباقة المناسبة'),
                        \Filament\Forms\Components\TextInput::make('pricing.title_en')->label('Title (EN)')->placeholder('Choose your plan'),
                    ]),
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\Textarea::make('pricing.subtitle_ar')->label('Subtitle (AR)')->rows(2),
                        \Filament\Forms\Components\Textarea::make('pricing.subtitle_en')->label('Subtitle (EN)')->rows(2),
                    ]),
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\TextInput::make('pricing.currency_ar')->label('Currency (AR)')->placeholder('ر.س')->default('ر.س'),
                        \Filament\Forms\Components\TextInput::make('pricing.currency_en')->label('Currency (EN)')->placeholder('SAR')->default('SAR'),
                    ]),
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\TextInput::make('pricing.footnote_ar')->label('Footnote (AR)')->placeholder('الأسعار شاملة الضريبة'),
                        \Filament\Forms\Components\TextInput::make('pricing.footnote_en')->label('Footnote (EN)')->placeholder('Prices include VAT'),
                    ]),
                ])
                ->columnSpanFull()
                ->collapsible(),

            \Filament\Forms\Components\Repeater::make('pricing.packages')
                ->label('Packages')
                ->helperText('Add 2 or 3 packages. Each can be paid yearly or quarterly.')
                ->minItems(0)
                ->maxItems(4)
                ->reorderable()
                ->collapsible()
                ->cloneable()
                ->itemLabel(fn (array $state): ?string => $state['name_en'] ?? $state['name_ar'] ?? 'New package')
                ->schema([
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\TextInput::make('name_ar')->label('Name (AR)')->required(),
                        \Filament\Forms\Components\TextInput::make('name_en')->label('Name (EN)')->required(),
                    ]),
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\Textarea::make('description_ar')->label('Description (AR)')->rows(2),
                        \Filament\Forms\Components\Textarea::make('description_en')->label('Description (EN)')->rows(2),
                    ]),
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\TextInput::make('yearly_price')->label('Yearly price')->numeric()->minValue(0)->required(),
                        \Filament\Forms\Components\TextInput::make('quarterly_price')->label('Quarterly price')->numeric()->minValue(0)->required()
                            ->helperText('Per quarter. The savings vs. 4× quarterly is shown automatically.'),
                    ]),
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\Repeater::make('features_ar')
                            ->label('Features (AR)')
                            ->simple(\Filament\Forms\Components\TextInput::make('feature')->required())
                            ->minItems(0),
                        \Filament\Forms\Components\Repeater::make('features_en')
                            ->label('Features (EN)')
                            ->simple(\Filament\Forms\Components\TextInput::make('feature')->required())
                            ->minItems(0),
                    ]),
                    \Filament\Schemas\Components\Grid::make(2)->schema([
                        \Filament\Forms\Components\TextInput::make('cta_text_ar')->label('CTA text (AR)')->placeholder('اشترك الآن'),
                        \Filament\Forms\Components\TextInput::make('cta_text_en')->label('CTA text (EN)')->placeholder('Get started'),
                    ]),
                    \Filament\Forms\Components\Toggle::make('is_featured')
                        ->label('Mark as most popular (highlighted card)')
                        ->default(false)
                        ->inline(false),
                ]),
        ];
    }

    /**
     * 11 named screenshot slots rendered as FileUpload fields.
     * Filament stores them under the `screenshots` JSON column as
     *   { hero: "...", pos: "...", channels: "...", ... }
     */
    protected static function iresScreenshotFields(): array
    {
        $slots = [
            ['hero',          'Hero — POS dashboard',                'Big animated mockup at the top of the page.'],
            ['pos',           'Capability 01 — POS / cashier',       'Cashier screen with order entry.'],
            ['channels',      'Capability 02 — Sales channels',      'Channel configuration screen.'],
            ['kitchen',       'Capability 03 — Kitchen display',     'Kitchen orders screen.'],
            ['counter',       'Capability 04 — Pickup & counter',    'Handover / counter screens.'],
            ['dispatch',      'Capability 05 — Dispatch board',      'Online / call-center order review.'],
            ['customer',      'Capability 06 — Customer profile',    'Customer card / history.'],
            ['inventory',     'Inventory — bulk stocktake',          'Wide screenshot under the inventory cards.'],
            ['financial',     'Financial dashboard',                 'Tall screenshot beside cash/bank/custody.'],
            ['reports',       'Reports — daily / P&L',               'Wide screenshot under the report cards.'],
            ['online_orders', 'Customer ordering site',              'Mockup of the customer-facing website.'],
        ];

        return array_map(
            fn (array $s) => \Filament\Forms\Components\FileUpload::make('screenshots.' . $s[0])
                ->label($s[1])
                ->helperText($s[2])
                ->image()
                ->disk('public')
                ->directory('products/ires-system')
                ->imageEditor()
                ->imagePreviewHeight('120'),
            $slots
        );
    }
}
