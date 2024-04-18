<?php

namespace App\Filament\AccountsPanel\Resources;

use App\Filament\AccountsPanel\Resources\ExpensetypesResource\Pages;
use App\Filament\AccountsPanel\Resources\ExpensetypesResource\RelationManagers;
use App\Models\Expensetypes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpensetypesResource extends Resource
{
    protected static ?string $model = Expensetypes::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $slug = 'settings/expense-types';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Expense Types';
    protected static ?string $modelLabel = 'Expense Types';
    protected static ?int $navigationSort = 2;
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('user_id')
            ->required()
            ->numeric(),
            Forms\Components\TextInput::make('expense_type')
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
            Tables\Columns\TextColumn::make('expense_type')
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
                        'index' => Pages\ListExpensetypes::route('/'),
                        'create' => Pages\CreateExpensetypes::route('/create'),
                        'edit' => Pages\EditExpensetypes::route('/{record}/edit'),
                    ];
                }
            }
            