<?php

namespace App\Filament\Resources\VendorsResource\Pages;

use App\Filament\Resources\VendorsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVendors extends CreateRecord
{
    protected static string $resource = VendorsResource::class;
    
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
