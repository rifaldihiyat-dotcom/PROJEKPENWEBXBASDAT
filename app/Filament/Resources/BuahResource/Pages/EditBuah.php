<?php

namespace App\Filament\Resources\BuahResource\Pages;

use App\Filament\Resources\BuahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBuah extends EditRecord
{
    protected static string $resource = BuahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
