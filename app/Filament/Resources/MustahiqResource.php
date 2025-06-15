<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MustahiqResource\Pages;
use App\Filament\Resources\MustahiqResource\RelationManagers;
use App\Models\Mustahiq;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MustahiqResource extends Resource
{
    protected static ?string $model = Mustahiq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama')
                    ->placeholder('Fulan bin Fulanah')
                    ->required(),
                Forms\Components\TextInput::make('no_hp')
                    ->label('Nomor HP')
                    ->placeholder('08123456789')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('kelas')
                    ->label('Kelas')
                    ->placeholder('10 A')
                    ->required(),
                Forms\Components\FileUpload::make('ttd_url')
                    ->label('Tanda Tangan')
                    ->image()
                    ->avatar()
                    ->downloadable()
                    ->directory('mustahiq-signatures')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor HP')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('ttd_url')->circular(),
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
            'index' => Pages\ListMustahiqs::route('/'),
            'create' => Pages\CreateMustahiq::route('/create'),
            'edit' => Pages\EditMustahiq::route('/{record}/edit'),
        ];
    }
}
