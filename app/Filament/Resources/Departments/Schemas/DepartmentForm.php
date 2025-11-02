<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Department;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),

                Select::make('parent_department_id')
                    ->label('Direction')
                    ->relationship(
                        name: 'parent',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->where('type', 'direction'),
                    )
                    ->nullable(),

                Select::make('type')
                    ->label('Type')
                    ->options([
                        'direction' => 'Direction',
                        'service' => 'Service',
                    ])
                    ->required(),
            ]);
    }
}
