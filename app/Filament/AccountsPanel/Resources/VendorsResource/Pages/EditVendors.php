<?php

namespace App\Filament\AccountsPanel\Resources\VendorsResource\Pages;

use App\Filament\AccountsPanel\Resources\VendorsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendors extends EditRecord
{
    protected static string $resource = VendorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
