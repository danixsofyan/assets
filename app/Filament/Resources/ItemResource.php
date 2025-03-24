<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Asset Management';

    protected static ?string $navigationLabel = 'Asset';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')->required(),
                    Select::make('category_id')
                        ->label('Kategori')
                        ->options(Category::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    Select::make('status_id')
                        ->label('Status')
                        ->options(Status::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    Select::make('location_id')
                        ->label('Lokasi')
                        ->options(
                            Location::all()->mapWithKeys(fn($location) => [
                                $location->id => "{$location->branch_name} - {$location->building_name} - LT {$location->floor} - {$location->room}"
                            ])
                        )
                        ->searchable()
                        ->disabled(fn($record) => $record !== null),
                    MarkdownEditor::make('description')->label('Description')->required(),
                    FileUpload::make('photo')->required()->image(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('category.name')->label('Kategori')->sortable()->searchable(),
                BadgeColumn::make('status.name')->label('Status')
                    ->colors([
                        'primary',
                        'success' => 'Baik',
                        'danger' => 'Rusak',
                        'warning' => 'Perlu Perbaikan',
                    ]),
                TextColumn::make('location_id')
                    ->label('Lokasi')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(
                        fn($record) =>
                        "{$record->location->branch_name} - {$record->location->building_name} - LT {$record->location->floor} - {$record->location->room}"
                    ),
                TextColumn::make('description')->label('Deskrpsi'),
                ImageColumn::make('photo')->label('Photo')
            ])
            ->filters([
                // TrashedFilter::make()->default(true),
                SelectFilter::make('location_id')
                    ->label('Location')
                    ->options(fn() => Location::all()->mapWithKeys(fn($location) => [
                        $location->id => "{$location->branch_name} - {$location->building_name} - LT {$location->floor} - {$location->room}"
                    ])->toArray())
                    ->searchable(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
