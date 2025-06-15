<?php

namespace App\Filament\Resources\IjinResource\Pages;

use App\Filament\Resources\IjinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIjin extends EditRecord
{
    protected static string $resource = IjinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
