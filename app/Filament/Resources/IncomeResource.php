<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Filament\Resources\IncomeResource\RelationManagers;
use App\Models\Income;
use App\Models\Incometypes;
use App\Models\Vendors;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;
    
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
                Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
                Forms\Components\DatePicker::make('transaction_date')
                ->required(),
                Forms\Components\Select::make('payment_method')
                ->required()
                ->options([
                    'Cash' => 'Cash',
                    'MoMO' => 'MoMo',
                    'Bank Transfer' => 'Bank Transfer'
                ]),
                Forms\Components\TextInput::make('amount')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('incometype_id')
                ->label('Income Type')
                ->required()
                ->options(Incometypes::pluck('income_type','id')),
                Forms\Components\Textarea::make('note')
                ->columnSpanFull(),
                Forms\Components\Select::make('vendor_id')
                ->label("Vendor")
                ->required()
                ->options(Vendors::pluck('name','id')),
                Forms\Components\TextInput::make('reference')
                ->required()
                ->maxLength(255),
                Forms\Components\FileUpload::make('attachment'),
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
                Tables\Columns\TextColumn::make('title')
                ->searchable(),
                Tables\Columns\TextColumn::make('transaction_date')
                ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                ->sortable()
                ->badge()
                ->state(function (Income $record): string {
                    return "GHC".$record->amount;
                }),
                Tables\Columns\TextColumn::make('intype.income_type')
                ->label('Income Type')
                ->sortable(),
                Tables\Columns\TextColumn::make('vendor.name')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('reference')
                ->searchable(),
                Tables\Columns\TextColumn::make('attachment')
                ->searchable(),
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
                            'index' => Pages\ListIncomes::route('/'),
                            'create' => Pages\CreateIncome::route('/create'),
                            'edit' => Pages\EditIncome::route('/{record}/edit'),
                        ];
                    }
                }
                