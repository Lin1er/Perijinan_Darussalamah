<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaliResource\Pages;
use App\Filament\Resources\WaliResource\RelationManagers;
use App\Models\Wali;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaliResource extends Resource
{
    protected static ?string $model = Wali::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_hp')
                    ->tel()
                    ->required()
                    ->maxLength(15)
                    ->label('Nomor HP'),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\FileUpload::make('image_url')
                    ->multiple()
                    ->image()
                    ->directory('wali-images')
                    ->label('Image')
                    ->required()
                    ->maxSize(1024 * 5), // 5 MB
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->circular(),
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
            'index' => Pages\ListWalis::route('/'),
            'create' => Pages\CreateWali::route('/create'),
            'edit' => Pages\EditWali::route('/{record}/edit'),
        ];
    }
}
