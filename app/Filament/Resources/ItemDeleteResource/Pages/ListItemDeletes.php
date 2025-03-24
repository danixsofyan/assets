<?php

namespace App\Filament\Resources\ItemDeleteResource\Pages;

use App\Filament\Resources\ItemDeleteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemDeletes extends ListRecords
{
    protected static string $resource = ItemDeleteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
