<?php

namespace App\Filament\AccountsPanel\Resources\ExpenseResource\Pages;

use App\Filament\AccountsPanel\Resources\ExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;
}
