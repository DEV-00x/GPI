<?php

namespace App\Filament\Resources\Maintenances\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MaintenanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(2)->components([
            TextInput::make('reference_number')
                ->label('Reference Number')
                ->required()
                ->maxLength(50)
                ->placeholder('e.g. MNT-2025-001'),

            Select::make('equipment_id')
                ->label('Equipment')
                ->relationship('equipment', 'inventory_number')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('technician_user_id')
                ->label('Technician')
                ->relationship('technician', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('related_demand_id')
                ->label('Related Demand')
                ->relationship('relatedDemand', 'reference_number')
                ->searchable()
                ->preload()
                ->nullable(),

            Select::make('type')
                ->label('Maintenance Type')
                ->options([
                    'corrective' => 'Corrective',
                    'preventive' => 'Preventive',
                    'predictive' => 'Predictive',
                ])
                ->default('corrective')
                ->required(),

            Select::make('status')
                ->label('Status')
                ->options([
                    'planned' => 'Planned',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('planned')
                ->required(),

            DateTimePicker::make('start_date')
                ->label('Start Date')
                ->native(false)
                ->required(),

            DateTimePicker::make('end_date')
                ->label('End Date')
                ->native(false)
                ->after('start_date')
                ->nullable(),

            Textarea::make('description')
                ->label('Description')
                ->rows(4)
                ->columnSpanFull()
                ->nullable(),
        ]);
    }
}
