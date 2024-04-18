<?php

namespace App\Filament\AccountsPanel\Resources\AssetsResource\Pages;

use App\Filament\AccountsPanel\Resources\AssetsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
