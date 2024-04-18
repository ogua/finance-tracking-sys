<?php

namespace App\Filament\AccountsPanel\Resources\PartiesResource\Pages;

use App\Filament\AccountsPanel\Resources\PartiesResource;
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
