<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppResource\Pages;
use App\Filament\Resources\AppResource\RelationManagers;
use App\Models\App;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppResource extends Resource
{
    protected static ?string $model = App::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                FileUpload::make('logo')->image()->required(),
                TextInput::make('slogan')->required(),
                TextInput::make('slogan_en')->required()->label('Slogan EN'),
                Textarea::make('whoweare')->required()->label('Who We Are FR'),
                Textarea::make('whoweare_en')->required()->label('Who We Are EN')->hintIcon('heroicon-s-translate'),
                TextInput::make('email')->email()->maxLength(150)->required(),
                TextInput::make('address')->maxLength(150)->required(),
                TextInput::make('phone_number')->label('Phone Number')->maxLength(20)->required(),
                TextInput::make('phone_number_two')->label('Phone Number Two')->maxLength(20)->required(),
                TextInput::make('website')->maxLength(50)->url()->required(),
                TextInput::make('facebook')->maxLength(50)->url()->required(),
                TextInput::make('instagram')->maxLength(50)->url()->required(),
                TextInput::make('twitter')->maxLength(50)->url(),
                TextInput::make('linkedin')->maxLength(50)->url(),
                TextInput::make('youtube')->maxLength(50)->url(),
                Textarea::make('email_sign')->label('Email Sign FR'),
                Textarea::make('email_sign_en')->label('Email Sign EN'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slogan'),
                Tables\Columns\TextColumn::make('email'),
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
            'index' => Pages\ListApps::route('/'),
            'create' => Pages\CreateApp::route('/create'),
            'edit' => Pages\EditApp::route('/{record}/edit'),
            'view' => Pages\ViewApp::route('/{record}'),
        ];
    }
}
