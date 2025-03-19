<?php

namespace App\Filament\Resources\ItemMovementResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Models\Item;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateItemMovement extends CreateRecord
{
    protected static string $resource = ItemMovementResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['moved_at'] = Carbon::now();

        if (empty($data['from_location_id']) && !empty($data['item_id'])) {
            $item = Item::find($data['item_id']);
            $data['from_location_id'] = $item?->location_id ?? null;
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = parent::handleRecordCreation($data);

        Item::where('id', $record->item_id)->update([
            'location_id' => $record->to_location_id
        ]);

        return $record;
    }
}
