<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionsResource\Pages;
use App\Filament\Resources\TransactionsResource\RelationManagers;
use App\Models\Accounts;
use App\Models\Parties;
use App\Models\Transactions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionsResource extends Resource
{
    protected static ?string $model = Transactions::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('')
            ->description('')
            ->schema([
                Forms\Components\Hidden::make('user_id')
                ->default(auth()->user()->id),
                Forms\Components\Select::make('sender_account_id')
                ->label('Sender Account')
                ->required()
                ->options(Accounts::pluck('account_name','id')),
                Forms\Components\Select::make('receiver_account_id')
                ->label('Receiver Account')
                ->required()
                ->options(Accounts::pluck('account_name','id')),
                Forms\Components\TextInput::make('amount')
                ->required()
                ->maxLength(255),
                Forms\Components\Textarea::make('description')
                ->required()
                ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('sender.account_name')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('receiver.account_name')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                ->sortable()
                ->badge()
                ->state(function (Transactions $record): string {
                    return "GHC".$record->amount;
                }),
                Tables\Columns\IconColumn::make('status')
                ->boolean(),
                // Tables\Columns\TextColumn::make('created_by')
                // ->numeric()
                // ->sortable(),
                // Tables\Columns\TextColumn::make('edited_by')
                // ->numeric()
                // ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                // ->dateTime()
                // ->sortable()
                // ->toggleable(isToggledHiddenByDefault: true),
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
                            'index' => Pages\ListTransactions::route('/'),
                            'create' => Pages\CreateTransactions::route('/create'),
                            'edit' => Pages\EditTransactions::route('/{record}/edit'),
                        ];
                    }
                }
                