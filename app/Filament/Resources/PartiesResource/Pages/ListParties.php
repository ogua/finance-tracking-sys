<?php

namespace App\Filament\Resources\PartiesResource\Pages;

use App\Filament\Resources\PartiesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParties extends ListRecords
{
    protected static string $resource = PartiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
