<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemDeleteResource\Pages;
use App\Filament\Resources\ItemDeleteResource\RelationManagers;
use App\Models\ItemDelete;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemDeleteResource extends Resource
{
    protected static ?string $model = ItemDelete::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Asset Management';

    protected static ?string $navigationLabel = 'Asset Dihapus';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item.name')
                    ->label('Nama asset')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('item.category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('fromLocation.branch_name')
                    ->label('Lokasi')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(
                        fn($record) =>
                        "{$record->fromLocation?->branch_name} - {$record->fromLocation?->building_name} - LT {$record->fromLocation?->floor} - {$record->fromLocation?->room}"
                    ),
                TextColumn::make('item.deleted_at')
                    ->label('Tanggal penghapusan')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('PIC')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListItemDeletes::route('/'),
            'create' => Pages\CreateItemDelete::route('/create'),
            'edit' => Pages\EditItemDelete::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
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
