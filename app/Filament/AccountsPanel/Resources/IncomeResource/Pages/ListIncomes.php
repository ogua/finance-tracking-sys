<?php

namespace App\Filament\AccountsPanel\Resources\IncomeResource\Pages;

use App\Filament\AccountsPanel\Resources\IncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
