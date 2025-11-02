<?php

namespace App\Filament\Resources\Demands\Pages;

use App\Filament\Resources\Demands\DemandResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDemand extends ViewRecord
{
    protected static string $resource = DemandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
