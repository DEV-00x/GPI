<?php

namespace App\Filament\Resources\Demands\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class DemandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reference_number')
                    ->label('Reference Number')
                    ->required(),

                TextInput::make('title')
                    ->label('Title')
                    ->required(),

                Select::make('type')
                    ->label('Type')
                    ->options([
                        'maintenance' => 'Maintenance',
                        'supply' => 'Supply',
                        'purchase' => 'Purchase',
                        'other' => 'Other',
                    ])
                    ->default('other')
                    ->required(),

                Select::make('requested_by_employee_id')
                    ->label('Requested By')
                    ->relationship('requestedBy', 'name')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),

                Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }
}
