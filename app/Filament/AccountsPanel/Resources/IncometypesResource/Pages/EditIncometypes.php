<?php

namespace App\Filament\AccountsPanel\Resources\IncometypesResource\Pages;

use App\Filament\AccountsPanel\Resources\IncometypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncometypes extends EditRecord
{
    protected static string $resource = IncometypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
