<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DepartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Department Name'),

                TextEntry::make('parent.name')
                    ->label('Direction')
                    ->placeholder('— None —'),

                TextEntry::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'service' => 'info',
                        'direction' => 'warning',
                        default => 'gray',
                    }),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i'),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}
