<?php

namespace App\Filament\Resources\Equipment\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EquipmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('inventory_number')
                    ->label('Inventory Number'),

                TextEntry::make('category')
                    ->label('Category')
                    ->badge()
                    ->colors([
                        'primary' => 'it',
                        'warning' => 'furniture',
                        'success' => 'vehicle',
                        'secondary' => 'other',
                    ]),

                TextEntry::make('type')
                    ->label('Type'),

                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                        'warning' => 'maintenance',
                        'secondary' => 'retired',
                    ]),

                TextEntry::make('location')
                    ->label('Location'),

                TextEntry::make('assignedEmployee.name')
                    ->label('Assigned Employee'),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}
