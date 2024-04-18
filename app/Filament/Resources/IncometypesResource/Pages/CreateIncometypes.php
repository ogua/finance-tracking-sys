<?php

namespace App\Filament\Resources\IncometypesResource\Pages;

use App\Filament\Resources\IncometypesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIncometypes extends CreateRecord
{
    protected static string $resource = IncometypesResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $data['created_by'] = auth()->user()->id;
        
        return $data;
    }
}
