<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountsResource\Pages;
use App\Filament\Resources\AccountsResource\RelationManagers;
use App\Models\Accounts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountsResource extends Resource
{
    protected static ?string $model = Accounts::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $modelLabel = 'Accounts Management';
    // protected static ?int $navigationSort = 1;
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('')
            ->description('')
            ->schema([
                Forms\Components\Hidden::make('user_id')
                ->default(auth()->user()->id),
                Forms\Components\TextInput::make('account_name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('balance')
                ->required()
                ->maxLength(255),
                // Forms\Components\Toggle::make('status')
                // ->required(),
                // Forms\Components\TextInput::make('created_by')
                // ->numeric()
                // ->default(null),
                // Forms\Components\TextInput::make('edited_by')
                // ->numeric()
                // ->default(null),
                ])
                ->columns(2),
            ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
            ->columns([
                Tables\Columns\TextColumn::make('account_name')
                ->searchable(),
                Tables\Columns\TextColumn::make('balance')
                ->sortable()
                ->badge()
                ->state(function (Accounts $record): string {
                    return "GHC ".$record->balance;
                }),
                Tables\Columns\IconColumn::make('status')
                ->boolean(),
                // Tables\Columns\TextColumn::make('created_by')
                // ->numeric()
                // ->sortable(),
                // Tables\Columns\TextColumn::make('edited_by')
                // ->numeric()
                // ->sortable(),
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
                        Tables\Actions\EditAction::make()
                        ->visible(fn () => isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == "Administration"),
                        Tables\Actions\ViewAction::make()
                        ->visible(fn () => isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == "Administration"),
                        Tables\Actions\DeleteAction::make()
                        ->visible(fn () => isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == "Administration"),
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
                            'index' => Pages\ListAccounts::route('/'),
                            'create' => Pages\CreateAccounts::route('/create'),
                            'edit' => Pages\EditAccounts::route('/{record}/edit'),
                        ];
                    }
                }
                