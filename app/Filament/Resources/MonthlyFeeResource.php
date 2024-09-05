<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonthlyFeeResource\Pages;
use App\Models\MonthlyFee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MonthlyFeeResource extends Resource
{
    protected static ?string $model = MonthlyFee::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Monthly Fees';

    protected static ?string $navigationGroup = 'Members Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->label('Member')
                    ->relationship('member', 'id')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\DatePicker::make('paid_date')
                    ->required(),
                Forms\Components\Toggle::make('paid')
                    ->label('Paid'),
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(50)
                    ->label('Reference'),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('member.id')->label('Member'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('paid_date'),
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\BooleanColumn::make('paid'),



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
            'index' => Pages\ListMonthlyFees::route('/'),
            'create' => Pages\CreateMonthlyFee::route('/create'),
            'edit' => Pages\EditMonthlyFee::route('/{record}/edit'),
        ];
    }
}
