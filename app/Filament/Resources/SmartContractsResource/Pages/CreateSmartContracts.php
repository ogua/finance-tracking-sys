<?php

namespace App\Filament\Resources\SmartContractsResource\Pages;

use App\Filament\Resources\SmartContractsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSmartContracts extends CreateRecord
{
    protected static string $resource = SmartContractsResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->id;
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
