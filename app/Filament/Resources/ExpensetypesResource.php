<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpensetypesResource\Pages;
use App\Filament\Resources\ExpensetypesResource\RelationManagers;
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
    protected static ?string $navigationLabel = 'Expenses Types';
    protected static ?string $modelLabel = 'Expenses Types';
    protected static ?int $navigationSort = 5;
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('')
            ->description('')
            ->schema([
                Forms\Components\Hidden::make('user_id')
                ->default(auth()->user()->id),
                Forms\Components\TextInput::make('expense_type')
                ->required(),
                Forms\Components\Hidden::make('created_by')
                ->visible(fn (string $operation): bool => $operation === 'create')
                ->default(auth()->user()->id),
                Forms\Components\TextInput::make('edited_by')
                ->visible(fn (string $operation): bool => $operation === 'edit')
                ->default(auth()->user()->id)
                ->live(),
                Forms\Components\TextInput::make('status')
                ->visible(fn (string $operation): bool => $operation === 'edit')
                ->default(1)
                ->live(),
                ])
                ->columns(2),
            ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
            ->columns([
                Tables\Columns\TextColumn::make('expense_type')
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
                            'index' => Pages\ListExpensetypes::route('/'),
                            //'create' => Pages\CreateExpensetypes::route('/create'),
                            //'edit' => Pages\EditExpensetypes::route('/{record}/edit'),
                        ];
                    }
                }
                