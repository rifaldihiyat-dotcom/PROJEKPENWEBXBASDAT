<?php

namespace App\Filament\Resources\BuahResource\Pages;

use App\Filament\Resources\BuahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBuahs extends ListRecords
{
    protected static string $resource = BuahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
