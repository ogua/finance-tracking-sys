<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncometypesResource\Pages;
use App\Filament\Resources\IncometypesResource\RelationManagers;
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
    
    protected static ?string $slug = 'settings/income-types';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Income Types';
    protected static ?string $modelLabel = 'Income Types';
    protected static ?int $navigationSort = 6;
    
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
                Forms\Components\TextInput::make('income_type')
                ->required()
                ->maxLength(255),
                Forms\Components\Hidden::make('status')
                ->default(0),
                Forms\Components\Hidden::make('created_by')
                ->default(auth()->user()->id),
                Forms\Components\Hidden::make('edited_by')
                ->default(auth()->user()->id),
                ])
                ->columns(2),
            ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
            ->columns([
                Tables\Columns\TextColumn::make('income_type'),
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
                            'index' => Pages\ListIncometypes::route('/'),
                            // 'create' => Pages\CreateIncometypes::route('/create'),
                            // 'edit' => Pages\EditIncometypes::route('/{record}/edit'),
                        ];
                    }
                }
                