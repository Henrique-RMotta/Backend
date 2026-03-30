<?php

namespace App\Filament\Resources\Permisions\Pages;

use App\Filament\Resources\Permisions\PermisionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPermision extends EditRecord
{
    protected static string $resource = PermisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
