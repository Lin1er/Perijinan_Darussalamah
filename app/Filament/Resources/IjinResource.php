<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IjinResource\Pages;
use App\Models\Ijin;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IjinResource extends Resource
{
    protected static ?string $model = Ijin::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('santri_id')
                    ->relationship('santri', 'nama')
                    ->label('Nama Santri')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_jemput')
                    ->label('Tanggal Dijemput')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->required(),
                Forms\Components\Textarea::make('alasan')
                    ->label('Keterangan')
                    ->rows(3),
                FileUpload::make('lampiran')
                    ->label('Lampiran')
                    ->disk('public')
                    ->directory('ijins')
                    ->preserveFilenames()
                    ->enableDownload()
                    ->enableOpen()
                    ->visibility('public')
                    ->acceptedFileTypes(['image/*', 'application/pdf'])
                    ->maxSize(10240) // 10 MB
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('santri.nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis Ijin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->date(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->date(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(30),
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
            'index' => Pages\ListIjins::route('/'),
            'create' => Pages\CreateIjin::route('/create'),
            'edit' => Pages\EditIjin::route('/{record}/edit'),
        ];
    }
}
