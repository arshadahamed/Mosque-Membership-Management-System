<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyResource\Pages;
use App\Filament\Resources\FamilyResource\RelationManagers;
use App\Models\Family;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static ?string $navigationIcon = 'heroicon-m-users';
    protected static ?string $navigationGroup = 'Members Management';
    protected static ?string $navigationLabel = 'Family Members';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name'),

                Forms\Components\Select::make('relationship')
                    ->options([
                        'wife' => 'Wife',
                        'son' => 'Son',
                        'daughter' => 'Daughter',
                        'other' => 'Other', // Add more options as needed
                    ])
                    ->required()
                    ->label('Relationship'),

                Forms\Components\TextInput::make('note')
                    ->label('Note'),

                // Forms\Components\Select::make('Status')
                //     ->options([
                //         'active' => 'Active',
                //         'inactive' => 'Inactive',
                //     ])
                //     ->required()
                //     ->label('Status'),


                Forms\Components\Select::make('member_id')
                    ->relationship('member', 'id')
                    ->searchable()
                    ->required()
                    ->label('Family Head'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name'),

                Tables\Columns\TextColumn::make('relationship')
                    ->label('Relationship'),

                Tables\Columns\TextColumn::make('member.id')
                    ->label('Memebr ID')
                    ->searchable(),

                Tables\Columns\TextColumn::make('note')
                    ->label('Note'),

                // Tables\Columns\TextColumn::make('member.Name_of_Family_Head')
                //     ->label('Family Head'),
            ])
            ->filters([
                // Add any filters here
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
            // Define relations if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
