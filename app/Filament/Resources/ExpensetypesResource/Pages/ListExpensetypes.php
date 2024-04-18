<?php

namespace App\Filament\Resources\ExpensetypesResource\Pages;

use App\Filament\Resources\ExpensetypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExpensetypes extends ListRecords
{
    protected static string $resource = ExpensetypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
