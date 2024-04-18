<?php

namespace App\Filament\Resources\IncometypesResource\Pages;

use App\Filament\Resources\IncometypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncometypes extends EditRecord
{
    protected static string $resource = IncometypesResource::class;
    
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
