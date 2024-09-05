<?php

namespace App\Filament\Resources\MemberResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamiliesRelationManager extends RelationManager
{
    protected static string $relationship = 'families';

    public function form(Form $form): Form
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


                // Forms\Components\Select::make('member_id')
                //     ->relationship('member', 'id')
                //     ->searchable()
                //     ->required()
                //     ->label('Family Head'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
