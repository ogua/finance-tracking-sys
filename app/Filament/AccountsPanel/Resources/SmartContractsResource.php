<?php

namespace App\Filament\AccountsPanel\Resources;

use App\Filament\AccountsPanel\Resources\SmartContractsResource\Pages;
use App\Filament\AccountsPanel\Resources\SmartContractsResource\RelationManagers;
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
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('contract_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('buyer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('seller_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('contract_terms')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('executiob_date')
                    ->required(),
                Forms\Components\DatePicker::make('expiry_date')
                    ->required(),
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
                Tables\Columns\TextColumn::make('contract_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('buyer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('seller_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('executiob_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListSmartContracts::route('/'),
            'create' => Pages\CreateSmartContracts::route('/create'),
            'edit' => Pages\EditSmartContracts::route('/{record}/edit'),
        ];
    }
}
