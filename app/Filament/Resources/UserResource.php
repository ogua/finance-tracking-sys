<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $slug = 'settings/users';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $modelLabel = 'Users';
    protected static ?int $navigationSort = 1;
    
    public static function shouldRegisterNavigation(): bool
    {
        if (isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == "Normal admin") {
            
            return false;
            
        }elseif (isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == "Accounts") {
            
            return false;
            
        }else{
            
            return true;
        }
    }
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
            ->required()
            ->maxLength(255),
            Forms\Components\TextInput::make('email')
            ->email()
            ->required()
            ->maxLength(255),
            Forms\Components\DateTimePicker::make('email_verified_at'),
            Forms\Components\TextInput::make('password')
            ->password()
            ->required()
            ->maxLength(255),
        ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
            ->searchable(),
            Tables\Columns\TextColumn::make('email')
            ->searchable(),
            Tables\Columns\TextColumn::make('roles.name')
            ->badge()
            ->searchable(),
            Tables\Columns\TextColumn::make('email_verified_at')
            ->dateTime()
            ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                ])
                ->actions([
                    Tables\Actions\Action::make("Assign role")
                    ->icon('heroicon-m-check-badge')
                    ->color('info')
                    ->form([
                        Forms\Components\Section::make('')
                        ->description('')
                        ->schema([
                            Forms\Components\Select::make('role')
                            ->options(Role::pluck('name','name'))
                            ->required(),
                            ])
                            ])
                            ->action(function (array $data, User $record) {
                                $record->syncRoles($data['role']);
                            }),
                            Tables\Actions\EditAction::make(),
                            Tables\Actions\DeleteAction::make(),
                            ])
                            ->bulkActions([
                                Tables\Actions\BulkActionGroup::make([
                                    Tables\Actions\DeleteBulkAction::make(),
                                ]),
                            ]);
                        }
                        
                        public static function getRelations(): array
                        {
                            return [
                                //
                            ];
                        }
                        
                        public static function getPages(): array
                        {
                            return [
                                'index' => Pages\ListUsers::route('/'),
                                //'create' => Pages\CreateUser::route('/create'),
                                //'edit' => Pages\EditUser::route('/{record}/edit'),
                            ];
                        }
                    }
                    