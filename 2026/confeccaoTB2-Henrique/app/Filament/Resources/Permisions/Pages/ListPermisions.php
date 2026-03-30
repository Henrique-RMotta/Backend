<?php

namespace App\Filament\Resources\Permisions\Pages;

use App\Filament\Resources\Permisions\PermisionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPermisions extends ListRecords
{
    protected static string $resource = PermisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
