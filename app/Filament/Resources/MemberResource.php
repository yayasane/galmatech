<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('title_en')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('description_en')
                    ->required()
                    ->maxLength(150),
                Forms\Components\FileUpload::make('picture')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('facebook')
                    ->maxLength(50),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(50),
                Forms\Components\TextInput::make('twiiter')
                    ->maxLength(50),
                Forms\Components\TextInput::make('linkedin')
                    ->maxLength(50),
                Select::make('app_id')
                    ->relationship('app', 'name')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('app_id'),
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('title_en'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('description_en'),
                Tables\Columns\TextColumn::make('picture'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('facebook'),
                Tables\Columns\TextColumn::make('instagram'),
                Tables\Columns\TextColumn::make('twiiter'),
                Tables\Columns\TextColumn::make('linkedin'),
                Tables\Columns\TextColumn::make('created_by_user_id'),
                Tables\Columns\TextColumn::make('updated_by_user_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
