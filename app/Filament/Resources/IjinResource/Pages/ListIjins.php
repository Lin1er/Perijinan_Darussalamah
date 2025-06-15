<?php

namespace App\Filament\Resources\IjinResource\Pages;

use App\Filament\Resources\IjinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIjins extends ListRecords
{
    protected static string $resource = IjinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
