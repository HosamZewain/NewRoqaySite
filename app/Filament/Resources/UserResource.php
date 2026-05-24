<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Admins';

    protected static ?string $modelLabel = 'Admin';

    protected static ?string $pluralModelLabel = 'Admins';

    protected static ?int $navigationSort = 99;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            \Filament\Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            \Filament\Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            \Filament\Forms\Components\TextInput::make('password')
                ->password()
                ->revealable()
                ->rule(Password::min(8))
                ->required(fn (string $operation): bool => $operation === 'create')
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                ->helperText(fn (string $operation): string => $operation === 'edit'
                    ? 'Leave blank to keep the current password.'
                    : 'Minimum 8 characters.')
                ->same('password_confirmation'),

            \Filament\Forms\Components\TextInput::make('password_confirmation')
                ->password()
                ->revealable()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->dehydrated(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id')
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make()
                    // Prevent self-deletion and never let the last admin be removed
                    ->visible(fn (User $record): bool => auth()->id() !== $record->id && User::count() > 1),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make()
                        ->before(function (\Filament\Actions\DeleteBulkAction $action, $records) {
                            // Block the operation if it would wipe the current user or every admin
                            $ids = collect($records)->pluck('id')->all();
                            if (in_array(auth()->id(), $ids) || count($ids) >= User::count()) {
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Cannot delete')
                                    ->body('You can\'t delete yourself or the last remaining admin.')
                                    ->send();
                                $action->cancel();
                            }
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
