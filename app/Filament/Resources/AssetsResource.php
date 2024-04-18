<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetsResource\Pages;
use App\Filament\Resources\AssetsResource\RelationManagers;
use App\Models\Assets;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetsResource extends Resource
{
    protected static ?string $model = Assets::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $modelLabel = 'Asset';
    
    protected static ?int $navigationSort = 1;
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('')
            ->description('')
            ->schema([
                Forms\Components\Hidden::make('user_id')
                ->default(auth()->user()->id),
                Forms\Components\TextInput::make('name')
                ->label('Name of assets')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('asset_type')
                ->required()
                ->options([
                    'Tangible Assets' => 'Tangible Assets',
                    'Intangible Assets' => 'Intangible Assets',
                    'Financial Assets' => 'Financial Assets',
                    'Investment Assets' => 'Investment Assets',
                    'Current Assets' => 'Current Assets',
                    'Fixed Assets' => 'Fixed Assets',
                    'Liquid Assets' => 'Liquid Assets',
                    'Non-Liquid Assets' => 'Non-Liquid Assets'
                ]),
                Forms\Components\TextInput::make('quantity')
                ->required()
                ->numeric()
                ->maxLength(255),
                Forms\Components\TextInput::make('value')
                ->label('Asset value')
                ->required()
                ->prefix('GHC')
                ->suffix('.00')
                ->maxLength(255),
                Forms\Components\Textarea::make('description')
                ->required()
                ->columnSpanFull(),
                ])
                ->columns(2),
            ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('asset_type')
                ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                ->sortable(),
                Tables\Columns\TextColumn::make('value')
                ->label('Asset Value')
                ->money('Ghc')
                ->badge()
                ->sortable(),
                Tables\Columns\IconColumn::make('status')
                ->boolean(),
                // Tables\Columns\TextColumn::make('editeduser.name')
                // ->searchable()
                // ->visible(function (Assets $record) : bool {
                    
                    //     if($record->status == '0'){
                        //         return false;
                        //     }
                        
                        //     return true;
                        // }),
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
                                    'index' => Pages\ListAssets::route('/'),
                                    'create' => Pages\CreateAssets::route('/create'),
                                    'edit' => Pages\EditAssets::route('/{record}/edit'),
                                ];
                            }
                        }
                        