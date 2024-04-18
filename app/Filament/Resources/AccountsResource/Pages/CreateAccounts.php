<?php

namespace App\Filament\Resources\AccountsResource\Pages;

use App\Filament\Resources\AccountsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccounts extends CreateRecord
{
    protected static string $resource = AccountsResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $data['created_by'] = auth()->user()->id;
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
