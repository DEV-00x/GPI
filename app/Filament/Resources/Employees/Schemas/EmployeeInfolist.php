<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Full Name'),

                TextEntry::make('registration_number')
                    ->label('Registration Number'),

                TextEntry::make('department_full')
                    ->label('Department / Division')
                    ->getStateUsing(function ($record) {
                        if ($record->department) {
                            $department = $record->department;
                            $division = $department->parent?->name;
                            return $division
                                ? $division . ' / ' . $department->name
                                : $department->name . ' / ' . $department->type;
                        }
                        return null;
                    }),

                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Created At'),

                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Updated At'),
            ]);
    }
}
