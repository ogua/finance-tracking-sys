<?php

namespace App\Filament\AccountsPanel\Resources\SmartContractsResource\Pages;

use App\Filament\AccountsPanel\Resources\SmartContractsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSmartContracts extends ListRecords
{
    protected static string $resource = SmartContractsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
