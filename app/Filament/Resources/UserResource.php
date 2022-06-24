<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Settings';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->group->slug == 'super-admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignorable: fn (?Model $record): ?Model => $record)
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Select::make('group_id')
                    ->relationship('group', 'name')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->same('passwordConfirmation')
                    ->required()
                    ->maxLength(255)
                    ->visible(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser),
                // ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                // ->visible(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser),
                Forms\Components\TextInput::make('passwordConfirmation')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser),
                Section::make('Update Password')
                    ->columns(2)
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Current Password')
                            ->password()
                            ->rules(['required_with:new_password'])
                            ->currentPassword()
                            ->autocomplete('off')
                            ->columnSpan(1),
                        Grid::make()
                            ->schema([
                                TextInput::make('new_password')
                                    ->label('New Password')
                                    ->password()
                                    ->rules(['confirmed'])
                                    ->autocomplete('new-password'),
                                TextInput::make('new_password_confirmation')
                                    ->label('Confirm Password')
                                    ->password()
                                    ->rules([
                                        'required_with:new_password',
                                    ])
                                    ->autocomplete('new-password'),
                            ]),
                    ])->visible(fn (Component $livewire): bool => $livewire instanceof Pages\EditUser),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\BooleanColumn::make('email_verified_at'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('group.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            // 'profile' => Pages\Profile::route('/profile'),
        ];
    }
}
