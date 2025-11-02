<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Full Name')
                    ->required(),

                TextInput::make('registration_number')
                    ->label('Registration Number')
                    ->required(),

                Select::make('department_id')
                    ->label('Department / Service')
                    ->relationship(
                        name: 'department',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->where('type', 'service')
                    )
                    ->required(),
            ]);
    }
}
