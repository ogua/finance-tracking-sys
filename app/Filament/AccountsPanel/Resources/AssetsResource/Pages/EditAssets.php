<?php

namespace App\Filament\AccountsPanel\Resources\AssetsResource\Pages;

use App\Filament\AccountsPanel\Resources\AssetsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssets extends EditRecord
{
    protected static string $resource = AssetsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
