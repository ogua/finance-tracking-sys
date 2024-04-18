<?php

namespace App\Filament\AccountsPanel\Resources;

use App\Filament\AccountsPanel\Resources\IncometypesResource\Pages;
use App\Filament\AccountsPanel\Resources\IncometypesResource\RelationManagers;
use App\Models\Incometypes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncometypesResource extends Resource
{
    protected static ?string $model = Incometypes::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $slug = 'settings/income-types';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Income Types';
    protected static ?string $modelLabel = 'Income Types';
    protected static ?int $navigationSort = 1;
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('user_id')
            ->required()
            ->numeric(),
            Forms\Components\TextInput::make('income_type')
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
            Tables\Columns\TextColumn::make('income_type')
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
                        'index' => Pages\ListIncometypes::route('/'),
                        'create' => Pages\CreateIncometypes::route('/create'),
                        'edit' => Pages\EditIncometypes::route('/{record}/edit'),
                    ];
                }
            }
            