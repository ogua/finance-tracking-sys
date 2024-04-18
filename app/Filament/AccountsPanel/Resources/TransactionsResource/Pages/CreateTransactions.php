<?php

namespace App\Filament\AccountsPanel\Resources\TransactionsResource\Pages;

use App\Filament\AccountsPanel\Resources\TransactionsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransactions extends CreateRecord
{
    protected static string $resource = TransactionsResource::class;
}
