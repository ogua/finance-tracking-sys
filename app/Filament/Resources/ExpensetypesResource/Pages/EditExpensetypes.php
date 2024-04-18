<?php

namespace App\Filament\Resources\ExpensetypesResource\Pages;

use App\Filament\Resources\ExpensetypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExpensetypes extends EditRecord
{
    protected static string $resource = ExpensetypesResource::class;
    
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
}
