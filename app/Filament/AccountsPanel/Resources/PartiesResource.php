<?php

namespace App\Filament\AccountsPanel\Resources;

use App\Filament\AccountsPanel\Resources\PartiesResource\Pages;
use App\Filament\AccountsPanel\Resources\PartiesResource\RelationManagers;
use App\Models\Parties;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartiesResource extends Resource
{
    protected static ?string $model = Parties::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $slug = 'settings/contract-parties';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Contract Parties';
    protected static ?string $modelLabel = 'Contract Parties';
    protected static ?int $navigationSort = 3;
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('user_id')
            ->required()
            ->numeric(),
            Forms\Components\TextInput::make('name')
            ->required()
            ->maxLength(255),
            Forms\Components\Textarea::make('address')
            ->required()
            ->columnSpanFull(),
            Forms\Components\TextInput::make('contact')
            ->required()
            ->maxLength(255),
            Forms\Components\TextInput::make('email')
            ->email()
            ->required()
            ->maxLength(255),
            Forms\Components\Toggle::make('status')
            ->required(),
            Forms\Components\TextInput::make('created_by')
            ->numeric()
            ->default(null),
            Forms\Components\TextInput::make('edited_by')
            ->numeric()
            ->default(null),
        ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('user_id')
            ->numeric()
            ->sortable(),
            Tables\Columns\TextColumn::make('name')
            ->searchable(),
            Tables\Columns\TextColumn::make('contact')
            ->searchable(),
            Tables\Columns\TextColumn::make('email')
            ->searchable(),
            Tables\Columns\IconColumn::make('status')
            ->boolean(),
            Tables\Columns\TextColumn::make('created_by')
            ->numeric()
            ->sortable(),
            Tables\Columns\TextColumn::make('edited_by')
            ->numeric()
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
                        'index' => Pages\ListParties::route('/'),
                        'create' => Pages\CreateParties::route('/create'),
                        'edit' => Pages\EditParties::route('/{record}/edit'),
                    ];
                }
            }
            