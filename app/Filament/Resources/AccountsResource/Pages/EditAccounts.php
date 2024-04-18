<?php

namespace App\Filament\Resources\AccountsResource\Pages;

use App\Filament\Resources\AccountsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccounts extends EditRecord
{
    protected static string $resource = AccountsResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['edited_by'] = auth()->user()->id;
        $data['status'] = 1;
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
