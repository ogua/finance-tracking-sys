<?php

namespace App\Filament\AccountsPanel\Resources\VendorsResource\Pages;

use App\Filament\AccountsPanel\Resources\VendorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendors extends ListRecords
{
    protected static string $resource = VendorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
