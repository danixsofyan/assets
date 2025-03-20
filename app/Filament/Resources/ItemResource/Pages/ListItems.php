<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder; // Pakai Eloquent Query Builder

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            '1' => Tab::make('Baik')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status_id', 1)),
            '2' => Tab::make('Rusak')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status_id', 2)),
            '3' => Tab::make('Perlu Perbaikan')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status_id', 3)),
        ];
    }
}
