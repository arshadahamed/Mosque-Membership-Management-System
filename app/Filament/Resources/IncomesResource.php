<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomesResource\Pages;
use App\Models\Incomes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Auth;

class IncomesResource extends Resource
{
    protected static ?string $model = Incomes::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Incomes')
                    ->description('Enter The Income Details')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->nullable()
                            ->columnSpanFull(),

                        Forms\Components\Select::make('type')
                            ->options([
                                'Friday' => 'Friday Collection',
                                'Nikah' => 'Nikah Form Collection',
                                'Donations' => 'Donation',
                                'Coconut' => 'Coconut Selling',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->label('Type')
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('amount')
                            ->label('Amount')
                            ->required()
                            ->numeric()
                            ->columnSpan(2),

                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->columnSpan(2)
                            ->nullable(),

                        Forms\Components\FileUpload::make('image')
                            ->disk('public')
                            ->directory('images')
                            ->label('Image')
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('reference_number')
                            ->label('Reference Number')
                            ->required()
                            ->unique()
                            ->columnSpan(2),

                        // Display the current user's name
                        Forms\Components\TextInput::make('user_name')
                            ->label('User Name')
                            ->default(Auth::user()->name)
                            ->columnSpan(2)
                            ->readOnly(),

                        // Hidden field for storing the user_id
                        Forms\Components\Hidden::make('user_id')
                            ->default(Auth::user()->id)
                            ->required(),
                    ])
                    ->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('reference_number'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('user_name') // Display user name instead of ID
                    ->label('User Name'),
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
            'index' => Pages\ListIncomes::route('/'),
            'create' => Pages\CreateIncomes::route('/create'),
            'edit' => Pages\EditIncomes::route('/{record}/edit'),
        ];
    }
}
