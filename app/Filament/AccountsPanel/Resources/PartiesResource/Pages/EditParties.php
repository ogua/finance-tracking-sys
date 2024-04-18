<?php

namespace App\Filament\AccountsPanel\Resources\PartiesResource\Pages;

use App\Filament\AccountsPanel\Resources\PartiesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParties extends EditRecord
{
    protected static string $resource = PartiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
