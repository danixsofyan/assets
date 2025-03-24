<?php

namespace App\Filament\Resources\ItemMovementResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Models\Item;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;

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
        // Pastikan kedua nilai ada
        if (!isset($data['from_location_id'], $data['to_location_id'])) {
            Notification::make()
                ->title('Gagal!')
                ->body('Lokasi asal dan tujuan harus diisi.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'to_location_id' => 'Lokasi asal dan tujuan harus diisi.',
            ]);
        }

        if ((int) $data['from_location_id'] === (int) $data['to_location_id']) {
            Notification::make()
                ->title('Validasi Gagal!')
                ->body('Lokasi tujuan tidak boleh sama dengan lokasi asal.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'to_location_id' => 'Lokasi tujuan tidak boleh sama dengan lokasi asal.',
            ]);
        }

        $record = parent::handleRecordCreation($data);

        Item::where('id', $record->item_id)->update([
            'location_id' => $record->to_location_id
        ]);

        return $record;
    }
}
