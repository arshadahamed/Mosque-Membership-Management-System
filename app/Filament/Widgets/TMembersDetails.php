<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TMembersDetails extends BaseWidget
{
    protected static ?string $heading = 'Members Details';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $defaultSortColumn = 'id';
    protected static ?string $defaultSortDirection = 'asc';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\Member::query()
            )
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('Name_of_Family_Head')
                    ->searchable(),
                TextColumn::make('NIC_Number')
                    ->label("NIC Number")
                    ->searchable(),
                TextColumn::make('Address'),
                TextColumn::make('Land_Mobile_Number')
                    ->label("Land / Mobile Number")
                    ->searchable(),
                TextColumn::make('Account_Balance')
                    ->label("Account Balance"),
                TextColumn::make('Number_of_Family_Members_Male')
                ->label("Male"),
                TextColumn::make('Number_of_Family_Members_Female')
                ->label("Female")
            ])
            ->defaultSort('id');  // Optional: Set default sorting by 'id'
    }
}
