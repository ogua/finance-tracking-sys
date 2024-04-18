<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeesResource\Pages;
use App\Filament\Resources\EmployeesResource\RelationManagers;
use App\Models\Employees;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;


class EmployeesResource extends Resource
{
    protected static ?string $model = Employees::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('')
            ->description('')
            ->schema([
                Forms\Components\Hidden::make('user_id')
                ->default(auth()->user()->id),
                Forms\Components\FileUpload::make('image')
                ->label('Pic')
                ->image()
                ->columnSpanFull(),
                Forms\Components\Select::make('title')
                ->required()
                ->options([
                    'Mr' => 'Mr',
                    'Mrs' => 'Mrs',
                    'Ms' => 'Ms'
                ]),
                Forms\Components\TextInput::make('surname')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('first_name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('other_names')
                ->maxLength(255)
                ->default(null),
                Forms\Components\Select::make('gender')
                ->required()
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female'
                ]),
                Forms\Components\DatePicker::make('date_of_birth')
                ->required(),
                Forms\Components\TextInput::make('phone_number')
                ->tel()
                ->required()
                ->minLength(10)
                ->maxLength(10),
                Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('qualification')
                ->required()
                ->options([
                    'First Degree' => 'First Degree',
                    'HND' => 'HND',
                    'Master Degree' => 'Masters Degree',
                    'Doctraite Degree' => 'Doctraite Degree',
                    'PHD' => 'PHD'
                ]),
                Forms\Components\Textarea::make('address')
                ->required()
                ->columnSpanFull(),
                Forms\Components\Select::make('role')
                ->required()
                ->options(Role::all()->pluck('name','name'))
                ])
                ->columns(2),
            ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                ->searchable(),
                // Tables\Columns\TextColumn::make('surname')
                // ->searchable(),
                // Tables\Columns\TextColumn::make('first_name')
                // ->searchable(),
                // Tables\Columns\TextColumn::make('other_names')
                // ->searchable(),
                Tables\Columns\TextColumn::make('fullname')
                ->searchable(['surname','first_name', 'other_names'])
                ->state(function (Employees $record): string {
                    return $record->surname." ".$record->first_name." ".$record->other_names;
                }),
                Tables\Columns\TextColumn::make('gender')
                ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->searchable(),
                Tables\Columns\TextColumn::make('qualification')
                ->searchable(),
                Tables\Columns\TextColumn::make('role')
                ->badge()
                ->searchable(),
                // Tables\Columns\TextColumn::make('created_by')
                // ->numeric()
                // ->sortable(),
                // Tables\Columns\TextColumn::make('edited_by')
                // ->numeric()
                // ->sortable()
                // ->toggleable(isToggledHiddenByDefault: true),
                //  Tables\Columns\TextColumn::make('created_at')
                //  ->dateTime()
                //  ->sortable()
                //  ->toggleable(isToggledHiddenByDefault: true),
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
                        Tables\Actions\ViewAction::make(),
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
                            'index' => Pages\ListEmployees::route('/'),
                            'create' => Pages\CreateEmployees::route('/create'),
                            'edit' => Pages\EditEmployees::route('/{record}/edit'),
                        ];
                    }
                }
                