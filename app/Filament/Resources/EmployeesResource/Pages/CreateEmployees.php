<?php

namespace App\Filament\Resources\EmployeesResource\Pages;

use App\Filament\Resources\EmployeesResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateEmployees extends CreateRecord
{
    protected static string $resource = EmployeesResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    
    protected function afterCreate(): void
    {
        $data = $this->getRecord();
        
        $name = $data->surname." ".$data->last_name." ".$data->first_name;
        $email = $data->email;
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        
        $user->assignRole($data->role);
        
    }
    
}
