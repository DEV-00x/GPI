<?php

namespace App\Filament\Resources\Maintenances\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MaintenanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(2)->components([
            TextEntry::make('reference_number')
                ->label('Référence'),

            TextEntry::make('equipment.inventory_number')
                ->label('Équipement'),

            TextEntry::make('technician.name')
                ->label('Technicien'),

            TextEntry::make('relatedDemand.reference_number')
                ->label('Demande liée'),

            TextEntry::make('type')
                ->label('Type de maintenance')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'preventive' => 'info',
                    'corrective' => 'warning',
                    'predictive' => 'success',
                    default => 'gray',
                }),

            TextEntry::make('status')
                ->label('Statut')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'planned' => 'gray',
                    'in_progress' => 'warning',
                    'completed' => 'success',
                    'cancelled' => 'danger',
                    default => 'gray',
                }),

            TextEntry::make('start_date')
                ->label('Date de début')
                ->dateTime('d/m/Y H:i'),

            TextEntry::make('end_date')
                ->label('Date de fin')
                ->dateTime('d/m/Y H:i'),

            TextEntry::make('description')
                ->label('Description')
                ->columnSpanFull(),

            TextEntry::make('created_at')
                ->label('Créé le')
                ->dateTime('d/m/Y H:i'),

            TextEntry::make('updated_at')
                ->label('Modifié le')
                ->dateTime('d/m/Y H:i'),
        ]);
    }
}
