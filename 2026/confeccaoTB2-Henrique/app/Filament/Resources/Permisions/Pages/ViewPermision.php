<?php

namespace App\Filament\Resources\Permisions\Pages;

use App\Filament\Resources\Permisions\PermisionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPermision extends ViewRecord
{
    protected static string $resource = PermisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
