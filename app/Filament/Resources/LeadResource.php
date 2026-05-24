<?php
namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                
            \Filament\Schemas\Components\Section::make('Contact Info')->schema([
                \Filament\Forms\Components\TextInput::make('name')->disabled(),
                \Filament\Forms\Components\TextInput::make('company_name')->disabled(),
                \Filament\Forms\Components\TextInput::make('phone')->disabled(),
                \Filament\Forms\Components\TextInput::make('email')->disabled(),
                \Filament\Forms\Components\TextInput::make('business_type')->disabled(),
            ])->columns(2),
            \Filament\Schemas\Components\Section::make('Interest')->schema([
                \Filament\Forms\Components\TextInput::make('interested_product')->disabled(),
                \Filament\Forms\Components\Textarea::make('message')->disabled()->columnSpanFull(),
            ]),
            \Filament\Schemas\Components\Section::make('Admin')->schema([
                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'qualified' => 'Qualified',
                        'closed' => 'Closed',
                        'rejected' => 'Rejected',
                    ])->required(),
                \Filament\Forms\Components\Textarea::make('admin_notes')->columnSpanFull(),
                \Filament\Forms\Components\TextInput::make('source')->disabled(),
            ])->columns(2)
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            \Filament\Tables\Columns\TextColumn::make('name')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('email')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('phone')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('interested_product')->searchable(),
            \Filament\Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'info' => 'new',
                    'warning' => 'contacted',
                    'success' => 'qualified',
                    'gray' => 'closed',
                    'danger' => 'rejected',
                ]),
            \Filament\Tables\Columns\TextColumn::make('source')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        
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
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
