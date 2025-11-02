<?php

namespace App\Filament\Resources\Demands;

use App\Filament\Resources\Demands\Pages\CreateDemand;
use App\Filament\Resources\Demands\Pages\EditDemand;
use App\Filament\Resources\Demands\Pages\ListDemands;
use App\Filament\Resources\Demands\Pages\ViewDemand;
use App\Filament\Resources\Demands\Schemas\DemandForm;
use App\Filament\Resources\Demands\Schemas\DemandInfolist;
use App\Filament\Resources\Demands\Tables\DemandsTable;
use App\Models\Demand;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class DemandResource extends Resource
{
    protected static ?string $model = Demand::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-s-clipboard-document-list';

    protected static ?string $recordTitleAttribute = 'ref_code';

    public static function form(Schema $schema): Schema
    {
        return DemandForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DemandInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemandsTable::configure($table);
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
            'index' => ListDemands::route('/'),
            'create' => CreateDemand::route('/create'),
            'view' => ViewDemand::route('/{record}'),
            'edit' => EditDemand::route('/{record}/edit'),
        ];
    }
}
