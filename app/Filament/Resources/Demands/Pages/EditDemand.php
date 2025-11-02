<?php

namespace App\Filament\Resources\Demands\Pages;

use App\Filament\Resources\Demands\DemandResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDemand extends EditRecord
{
    protected static string $resource = DemandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
