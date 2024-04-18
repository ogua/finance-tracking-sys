<?php

namespace App\Filament\Resources\ExpensetypesResource\Pages;

use App\Filament\Resources\ExpensetypesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpensetypes extends CreateRecord
{
    protected static string $resource = ExpensetypesResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $data['created_by'] = auth()->user()->id;
        
        return $data;
    }
    
    protected function afterCreate(): void
    {
        logger('model hooks working well');
    }
}
