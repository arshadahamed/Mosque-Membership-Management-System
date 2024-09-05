<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QurbanGiftResource\Pages;
use App\Filament\Resources\QurbanGiftResource\RelationManagers;
use App\Models\QurbanGift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Member;


class QurbanGiftResource extends Resource
{
    protected static ?string $model = QurbanGift::class;

    protected static ?string $navigationLabel = 'Qurban Details';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Qurban Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->relationship('member', 'id')
                    ->required()
                    ->label('Member')
                    ->options(function () {
                        return Member::active()->pluck('id', 'id');
                    }),
                Forms\Components\Toggle::make('received')
                    ->label('Received Qurban')
                    ->default(false),

                Forms\Components\DatePicker::make('gift_date')
                    ->label('Gift Date')
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->label('Quantity')
                    ->default(0)
                    ->required(),

                Forms\Components\TextInput::make('qurban_year')
                    ->numeric()
                    ->label('Qurban Year')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Member ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('member.Name_of_Family_Head')
                    ->label('Family Head Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('qurban_year')
                    ->label('Qurban Year')
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantity')
                    ->toggleable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gift_date')
                    ->label('Given Date')
                    ->date(),

                Tables\Columns\BooleanColumn::make('received')
                    ->label('Received Qurban')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->dateTime(),
            ])
            ->filters([])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQurbanGifts::route('/'),
            'create' => Pages\CreateQurbanGift::route('/create'),
            'edit' => Pages\EditQurbanGift::route('/{record}/edit'),
        ];
    }
}
