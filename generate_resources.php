<?php
require __DIR__.'/vendor/autoload.php';

$resources = [
    'Product' => [
        'fields' => "
            Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Arabic Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_ar')->required(),
                            Forms\Components\TextInput::make('slug_ar')->required(),
                            Forms\Components\Textarea::make('short_description_ar')->required(),
                            Forms\Components\RichEditor::make('description_ar')->required(),
                            Forms\Components\TextInput::make('hero_headline_ar'),
                            Forms\Components\Textarea::make('hero_subheadline_ar'),
                            Forms\Components\Textarea::make('target_audience_ar'),
                            Forms\Components\Repeater::make('features_ar')
                                ->simple(Forms\Components\TextInput::make('feature')->required()),
                            Forms\Components\Repeater::make('benefits_ar')
                                ->simple(Forms\Components\TextInput::make('benefit')->required()),
                            Forms\Components\Repeater::make('modules_ar')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->required(),
                                    Forms\Components\Textarea::make('description')->required(),
                                    Forms\Components\TextInput::make('icon'),
                                ]),
                            Forms\Components\Repeater::make('implementation_steps_ar')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->required(),
                                    Forms\Components\Textarea::make('description')->required(),
                                ]),
                        ]),
                    Forms\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_en')->required(),
                            Forms\Components\TextInput::make('slug_en')->required(),
                            Forms\Components\Textarea::make('short_description_en')->required(),
                            Forms\Components\RichEditor::make('description_en')->required(),
                            Forms\Components\TextInput::make('hero_headline_en'),
                            Forms\Components\Textarea::make('hero_subheadline_en'),
                            Forms\Components\Textarea::make('target_audience_en'),
                            Forms\Components\Repeater::make('features_en')
                                ->simple(Forms\Components\TextInput::make('feature')->required()),
                            Forms\Components\Repeater::make('benefits_en')
                                ->simple(Forms\Components\TextInput::make('benefit')->required()),
                            Forms\Components\Repeater::make('modules_en')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->required(),
                                    Forms\Components\Textarea::make('description')->required(),
                                    Forms\Components\TextInput::make('icon'),
                                ]),
                            Forms\Components\Repeater::make('implementation_steps_en')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->required(),
                                    Forms\Components\Textarea::make('description')->required(),
                                ]),
                        ]),
                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\TextInput::make('icon'),
                            Forms\Components\FileUpload::make('featured_image')->image()->directory('products'),
                            Forms\Components\FileUpload::make('gallery_images')->image()->multiple()->directory('products'),
                            Forms\Components\FileUpload::make('og_image')->image()->directory('seo'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO Arabic')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title_ar'),
                            Forms\Components\Textarea::make('seo_description_ar'),
                            Forms\Components\TextInput::make('seo_keywords_ar'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO English')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title_en'),
                            Forms\Components\Textarea::make('seo_description_en'),
                            Forms\Components\TextInput::make('seo_keywords_en'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                            Forms\Components\Toggle::make('is_active')->default(true),
                        ]),
                ])->columnSpanFull()
        ",
        'columns' => "
            Tables\Columns\ImageColumn::make('featured_image'),
            Tables\Columns\TextColumn::make('title_ar')->searchable(),
            Tables\Columns\TextColumn::make('title_en')->searchable(),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\ToggleColumn::make('is_active'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        "
    ],
    'Service' => [
        'fields' => "
            Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Arabic Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_ar')->required(),
                            Forms\Components\TextInput::make('slug_ar')->required(),
                            Forms\Components\Textarea::make('short_description_ar')->required(),
                            Forms\Components\RichEditor::make('content_ar'),
                        ]),
                    Forms\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_en')->required(),
                            Forms\Components\TextInput::make('slug_en')->required(),
                            Forms\Components\Textarea::make('short_description_en')->required(),
                            Forms\Components\RichEditor::make('content_en'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\TextInput::make('icon'),
                            Forms\Components\FileUpload::make('image')->image()->directory('services'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO Arabic')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title_ar'),
                            Forms\Components\Textarea::make('seo_description_ar'),
                            Forms\Components\TextInput::make('seo_keywords_ar'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO English')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title_en'),
                            Forms\Components\Textarea::make('seo_description_en'),
                            Forms\Components\TextInput::make('seo_keywords_en'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                            Forms\Components\Toggle::make('is_active')->default(true),
                        ]),
                ])->columnSpanFull()
        ",
        'columns' => "
            Tables\Columns\ImageColumn::make('image'),
            Tables\Columns\TextColumn::make('title_ar')->searchable(),
            Tables\Columns\TextColumn::make('title_en')->searchable(),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\ToggleColumn::make('is_active'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        "
    ],
    'BlogPost' => [
        'fields' => "
            Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Arabic Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_ar')->required(),
                            Forms\Components\TextInput::make('slug_ar')->required(),
                            Forms\Components\Textarea::make('excerpt_ar'),
                            Forms\Components\RichEditor::make('content_ar')->required(),
                        ]),
                    Forms\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_en')->required(),
                            Forms\Components\TextInput::make('slug_en')->required(),
                            Forms\Components\Textarea::make('excerpt_en'),
                            Forms\Components\RichEditor::make('content_en')->required(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\FileUpload::make('featured_image')->image()->directory('blog'),
                            Forms\Components\FileUpload::make('og_image')->image()->directory('seo'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title_ar'),
                            Forms\Components\Textarea::make('seo_description_ar'),
                            Forms\Components\TextInput::make('seo_title_en'),
                            Forms\Components\Textarea::make('seo_description_en'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\TextInput::make('author_name'),
                            Forms\Components\TextInput::make('category'),
                            Forms\Components\Select::make('status')
                                ->options(['draft' => 'Draft', 'published' => 'Published'])
                                ->default('draft')
                                ->required(),
                            Forms\Components\DateTimePicker::make('published_at'),
                        ]),
                ])->columnSpanFull()
        ",
        'columns' => "
            Tables\Columns\ImageColumn::make('featured_image'),
            Tables\Columns\TextColumn::make('title_ar')->searchable(),
            Tables\Columns\TextColumn::make('category')->searchable(),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'gray' => 'draft',
                    'success' => 'published',
                ]),
            Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
        "
    ],
    'Testimonial' => [
        'fields' => "
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('client_name_ar')->required(),
                Forms\Components\TextInput::make('client_name_en')->required(),
                Forms\Components\TextInput::make('company_ar'),
                Forms\Components\TextInput::make('company_en'),
                Forms\Components\TextInput::make('position_ar'),
                Forms\Components\TextInput::make('position_en'),
                Forms\Components\Textarea::make('review_ar')->required()->columnSpanFull(),
                Forms\Components\Textarea::make('review_en')->required()->columnSpanFull(),
                Forms\Components\FileUpload::make('image')->image()->directory('testimonials')->columnSpanFull(),
                Forms\Components\Select::make('rating')
                    ->options([1=>'1 Star', 2=>'2 Stars', 3=>'3 Stars', 4=>'4 Stars', 5=>'5 Stars'])
                    ->default(5)
                    ->required(),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->default(true),
            ])
        ",
        'columns' => "
            Tables\Columns\ImageColumn::make('image'),
            Tables\Columns\TextColumn::make('client_name_ar')->searchable(),
            Tables\Columns\TextColumn::make('company_ar')->searchable(),
            Tables\Columns\TextColumn::make('rating')->sortable(),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\ToggleColumn::make('is_active'),
        "
    ],
    'Faq' => [
        'fields' => "
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('question_ar')->required(),
                Forms\Components\TextInput::make('question_en')->required(),
                Forms\Components\Textarea::make('answer_ar')->required()->columnSpanFull(),
                Forms\Components\Textarea::make('answer_en')->required()->columnSpanFull(),
                Forms\Components\TextInput::make('category'),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'title_ar')
                    ->searchable()
                    ->nullable(),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->default(true),
            ])
        ",
        'columns' => "
            Tables\Columns\TextColumn::make('question_ar')->searchable(),
            Tables\Columns\TextColumn::make('category')->searchable(),
            Tables\Columns\TextColumn::make('product.title_ar')->searchable(),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\ToggleColumn::make('is_active'),
        "
    ],
    'Lead' => [
        'fields' => "
            Forms\Components\Section::make('Contact Info')->schema([
                Forms\Components\TextInput::make('name')->disabled(),
                Forms\Components\TextInput::make('company_name')->disabled(),
                Forms\Components\TextInput::make('phone')->disabled(),
                Forms\Components\TextInput::make('email')->disabled(),
                Forms\Components\TextInput::make('business_type')->disabled(),
            ])->columns(2),
            Forms\Components\Section::make('Interest')->schema([
                Forms\Components\TextInput::make('interested_product')->disabled(),
                Forms\Components\Textarea::make('message')->disabled()->columnSpanFull(),
            ]),
            Forms\Components\Section::make('Admin')->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'qualified' => 'Qualified',
                        'closed' => 'Closed',
                        'rejected' => 'Rejected',
                    ])->required(),
                Forms\Components\Textarea::make('admin_notes')->columnSpanFull(),
                Forms\Components\TextInput::make('source')->disabled(),
            ])->columns(2)
        ",
        'columns' => "
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('phone')->searchable(),
            Tables\Columns\TextColumn::make('interested_product')->searchable(),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'info' => 'new',
                    'warning' => 'contacted',
                    'success' => 'qualified',
                    'gray' => 'closed',
                    'danger' => 'rejected',
                ]),
            Tables\Columns\TextColumn::make('source')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        "
    ],
    'HomepageSection' => [
        'fields' => "
            Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('General')
                        ->schema([
                            Forms\Components\TextInput::make('section_key')->required()->disabledOn('edit'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Arabic Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_ar'),
                            Forms\Components\Textarea::make('subtitle_ar'),
                            Forms\Components\RichEditor::make('content_ar'),
                            Forms\Components\TextInput::make('button_text_ar'),
                        ]),
                    Forms\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_en'),
                            Forms\Components\Textarea::make('subtitle_en'),
                            Forms\Components\RichEditor::make('content_en'),
                            Forms\Components\TextInput::make('button_text_en'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\FileUpload::make('image')->image()->directory('sections'),
                            Forms\Components\FileUpload::make('background_image')->image()->directory('sections'),
                            Forms\Components\TextInput::make('button_url'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Extra Data')
                        ->schema([
                            Forms\Components\Textarea::make('extra_data')
                                ->afterStateHydrated(function (Forms\Components\Textarea \$component, \$state) {
                                    \$component->state(is_array(\$state) ? json_encode(\$state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : \$state);
                                })
                                ->dehydrateStateUsing(fn (\$state) => is_string(\$state) && !empty(\$state) ? json_decode(\$state, true) : null)
                                ->rows(10),
                        ]),
                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                            Forms\Components\Toggle::make('is_active')->default(true),
                        ]),
                ])->columnSpanFull()
        ",
        'columns' => "
            Tables\Columns\TextColumn::make('section_key')->searchable(),
            Tables\Columns\TextColumn::make('title_ar')->searchable(),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\ToggleColumn::make('is_active'),
        "
    ],
    'Page' => [
        'fields' => "
            Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Arabic Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_ar')->required(),
                            Forms\Components\TextInput::make('slug_ar')->required(),
                            Forms\Components\RichEditor::make('content_ar')->required(),
                        ]),
                    Forms\Components\Tabs\Tab::make('English Content')
                        ->schema([
                            Forms\Components\TextInput::make('title_en')->required(),
                            Forms\Components\TextInput::make('slug_en')->required(),
                            Forms\Components\RichEditor::make('content_en')->required(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\FileUpload::make('featured_image')->image()->directory('pages'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO Arabic')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title_ar'),
                            Forms\Components\Textarea::make('seo_description_ar'),
                            Forms\Components\TextInput::make('seo_keywords_ar'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO English')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title_en'),
                            Forms\Components\Textarea::make('seo_description_en'),
                            Forms\Components\TextInput::make('seo_keywords_en'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->default(true),
                        ]),
                ])->columnSpanFull()
        ",
        'columns' => "
            Tables\Columns\TextColumn::make('title_ar')->searchable(),
            Tables\Columns\TextColumn::make('slug_ar')->searchable(),
            Tables\Columns\ToggleColumn::make('is_active'),
        "
    ],
    'MenuItem' => [
        'fields' => "
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('label_ar')->required(),
                Forms\Components\TextInput::make('label_en')->required(),
                Forms\Components\TextInput::make('url_ar')->required(),
                Forms\Components\TextInput::make('url_en')->required(),
                Forms\Components\Select::make('location')
                    ->options(['header' => 'Header', 'footer' => 'Footer'])
                    ->default('header')
                    ->required(),
                Forms\Components\Toggle::make('open_in_new_tab')->default(false),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->default(true),
            ])
        ",
        'columns' => "
            Tables\Columns\TextColumn::make('label_ar')->searchable(),
            Tables\Columns\TextColumn::make('label_en')->searchable(),
            Tables\Columns\BadgeColumn::make('location'),
            Tables\Columns\TextColumn::make('url_ar')->searchable(),
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\ToggleColumn::make('is_active'),
        "
    ],
    'SiteSetting' => [
        'fields' => "
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('key')->required()->unique(ignoreRecord: true),
                Forms\Components\Select::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Social',
                        'seo' => 'SEO',
                        'scripts' => 'Scripts',
                        'footer' => 'Footer',
                    ])->required()->default('general'),
                Forms\Components\Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                        'boolean' => 'Boolean',
                        'json' => 'JSON',
                    ])->required()->default('text'),
                Forms\Components\Textarea::make('value')->columnSpanFull(),
            ])
        ",
        'columns' => "
            Tables\Columns\TextColumn::make('key')->searchable(),
            Tables\Columns\BadgeColumn::make('group')->searchable(),
            Tables\Columns\TextColumn::make('type'),
            Tables\Columns\TextColumn::make('value')->limit(50),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
        "
    ],
];

foreach ($resources as $modelName => $data) {
    $resourceName = $modelName . 'Resource';
    $modelClass = 'App\\Models\\' . $modelName;
    $resourceDir = __DIR__ . '/app/Filament/Resources/';
    $pagesDir = $resourceDir . $resourceName . '/Pages/';
    
    if (!is_dir($pagesDir)) {
        mkdir($pagesDir, 0777, true);
    }
    
    // Create Resource File
    $resourceCode = "<?php
namespace App\Filament\Resources;

use App\Filament\Resources\\{$resourceName}\Pages;
use App\Models\\{$modelName};
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class {$resourceName} extends Resource
{
    protected static ?string \$model = {$modelName}::class;
    protected static ?string \$navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form \$form): Form
    {
        return \$form
            ->schema([
                {$data['fields']}
            ]);
    }

    public static function table(Table \$table): Table
    {
        return \$table
            ->columns([
                {$data['columns']}
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\List" . \Illuminate\Support\Str::plural($modelName) . "::route('/'),
            'create' => Pages\Create{$modelName}::route('/create'),
            'edit' => Pages\Edit{$modelName}::route('/{record}/edit'),
        ];
    }
}
";
    file_put_contents($resourceDir . $resourceName . '.php', $resourceCode);

    // Create Pages
    $pluralModel = \Illuminate\Support\Str::plural($modelName);
    
    // List Page
    $listCode = "<?php
namespace App\Filament\Resources\\{$resourceName}\Pages;

use App\Filament\Resources\\{$resourceName};
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class List{$pluralModel} extends ListRecords
{
    protected static string \$resource = {$resourceName}::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
";
    file_put_contents($pagesDir . 'List' . $pluralModel . '.php', $listCode);

    // Create Page
    $createCode = "<?php
namespace App\Filament\Resources\\{$resourceName}\Pages;

use App\Filament\Resources\\{$resourceName};
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class Create{$modelName} extends CreateRecord
{
    protected static string \$resource = {$resourceName}::class;
}
";
    file_put_contents($pagesDir . 'Create' . $modelName . '.php', $createCode);

    // Edit Page
    $editCode = "<?php
namespace App\Filament\Resources\\{$resourceName}\Pages;

use App\Filament\Resources\\{$resourceName};
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class Edit{$modelName} extends EditRecord
{
    protected static string \$resource = {$resourceName}::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
";
    file_put_contents($pagesDir . 'Edit' . $modelName . '.php', $editCode);
}
echo "Resources generated successfully.\n";
