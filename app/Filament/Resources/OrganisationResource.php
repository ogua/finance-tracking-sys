<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganisationResource\Pages;
use App\Filament\Resources\OrganisationResource\RelationManagers;
use App\Models\Organisation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganisationResource extends Resource
{
    protected static ?string $model = Organisation::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $slug = 'settings/organisation';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Organisation';
    protected static ?string $modelLabel = 'Organisation';
    protected static ?int $navigationSort = 4;
    
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
            Forms\Components\Section::make('')
            ->description('')
            ->schema([
                Forms\Components\FileUpload::make('logo')
                ->image()
                ->columnSpanFull()
                ->required(),
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('registration_number')
                ->required()
                ->maxLength(255),
                ])
                ->columns(2),
            ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo'),
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('registration_number')
                ->searchable(),
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
                        Tables\Actions\EditAction::make(),
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
                            'index' => Pages\ListOrganisations::route('/'),
                            'create' => Pages\CreateOrganisation::route('/create'),
                            'edit' => Pages\EditOrganisation::route('/{record}/edit'),
                        ];
                    }
                }
                