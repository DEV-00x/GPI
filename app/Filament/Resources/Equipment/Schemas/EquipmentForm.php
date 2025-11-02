<?php

namespace App\Filament\Resources\Equipment\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EquipmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('inventory_number')
                    ->label('Inventory Number')
                    ->required(),

                Select::make('category')
                    ->label('Category')
                    ->options([
                        'it' => 'IT',
                        'furniture' => 'Furniture',
                        'vehicle' => 'Vehicle',
                        'other' => 'Other',
                    ])
                    ->default('other')
                    ->required(),

                TextInput::make('type')
                    ->label('Type'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'maintenance' => 'Maintenance',
                        'retired' => 'Retired',
                    ])
                    ->default('active')
                    ->required(),

                TextInput::make('location')
                    ->label('Location'),

                Select::make('assigned_employee_id')
                    ->label('Assigned Employee')
                    ->relationship('assignedEmployee', 'name'),
            ]);
    }
}
