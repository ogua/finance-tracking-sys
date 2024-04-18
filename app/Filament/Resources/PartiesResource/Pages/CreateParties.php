<?php

namespace App\Filament\Resources\PartiesResource\Pages;

use App\Filament\Resources\PartiesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateParties extends CreateRecord
{
    protected static string $resource = PartiesResource::class;
    
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
