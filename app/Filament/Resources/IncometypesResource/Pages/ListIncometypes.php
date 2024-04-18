<?php

namespace App\Filament\Resources\IncometypesResource\Pages;

use App\Filament\Resources\IncometypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncometypes extends ListRecords
{
    protected static string $resource = IncometypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
