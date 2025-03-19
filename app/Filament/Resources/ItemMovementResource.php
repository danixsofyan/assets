<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemMovementResource\Pages;
use App\Filament\Resources\ItemMovementResource\RelationManagers;
use App\Models\Item;
use App\Models\ItemMovement;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemMovementResource extends Resource
{
    protected static ?string $model = ItemMovement::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Asset Management';

    protected static ?string $navigationLabel = 'Mutasi Asset';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('item_id')
                        ->label('Nama asset')
                        ->options(Item::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $item = Item::find($state);
                            $set('from_location_id', $item?->location_id ?? null);
                            $set('from_location', $item?->location?->full_location ?? 'N/A');
                        }),
                    TextInput::make('from_location_id')
                        ->label('From Location ID')
                        ->hidden(),
                    TextInput::make('from_location')
                        ->label('Asal lokasi')
                        ->default('N/A')
                        ->disabled()
                        ->afterStateHydrated(
                            fn($state, callable $set, $record) =>
                            $set('from_location', $record && $record->fromLocation
                                ? "{$record->fromLocation->branch_name} - {$record->fromLocation->building_name} (Lantai {$record->fromLocation->floor})"
                                : 'N/A')
                        ),
                    Select::make('to_location_id')
                        ->label('Tujuan lokasi')
                        ->options(
                            Location::all()->mapWithKeys(fn($location) => [
                                $location->id => "{$location->branch_name} - {$location->building_name} (Lantai {$location->floor})"
                            ])
                        )
                        ->searchable(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('PIC')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('item.name')
                    ->label('Nama asset')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('fromLocation.branch_name')
                    ->label('Asal lokasi')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(
                        fn($record) =>
                        "{$record->fromLocation?->branch_name} - {$record->fromLocation?->building_name} (Lantai {$record->fromLocation?->floor})"
                    ),
                TextColumn::make('toLocation.branch_name')
                    ->label('Tujuan lokasi')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(
                        fn($record) =>
                        "{$record->toLocation?->branch_name} - {$record->toLocation?->building_name} (Lantai {$record->toLocation?->floor})"
                    ),
                TextColumn::make('moved_at')
                    ->label('Tanggal mutasi')
                    ->sortable(),

            ])

            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListItemMovements::route('/'),
            'create' => Pages\CreateItemMovement::route('/create'),
            'edit' => Pages\EditItemMovement::route('/{record}/edit'),
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
