<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmartContractsResource\Pages;
use App\Filament\Resources\SmartContractsResource\RelationManagers;
use App\Models\Parties;
use App\Models\SmartContracts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SmartContractsResource extends Resource
{
    protected static ?string $model = SmartContracts::class;
    
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
                Forms\Components\TextInput::make('contract_code')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('buyer_id')
                ->label('Buyer')
                ->required()
                ->options(Parties::pluck('name','id')),
                Forms\Components\Select::make('seller_id')
                ->label('Seller')
                ->required()
                ->options(Parties::pluck('name','id')),
                Forms\Components\Textarea::make('contract_terms')
                ->required()
                ->columnSpanFull(),
                Forms\Components\DatePicker::make('executiob_date')
                ->label('Execution date')
                ->required(),
                Forms\Components\DatePicker::make('expiry_date')
                ->required(),
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
                // Tables\Columns\TextColumn::make('user_id')
                // ->numeric()
                // ->sortable(),
                Tables\Columns\TextColumn::make('contract_code')
                ->searchable(),
                Tables\Columns\TextColumn::make('buyer.name')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('seller.name')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('executiob_date')
                ->label('Execution date')
                ->date()
                ->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')
                ->date()
                ->sortable(),
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
                            'index' => Pages\ListSmartContracts::route('/'),
                            'create' => Pages\CreateSmartContracts::route('/create'),
                            'edit' => Pages\EditSmartContracts::route('/{record}/edit'),
                        ];
                    }
                }
                