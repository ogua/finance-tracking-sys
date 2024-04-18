<?php

namespace App\Filament\Resources\AssetsResource\Pages;

use App\Filament\Resources\AssetsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssets extends CreateRecord
{
    protected static string $resource = AssetsResource::class;
    
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
