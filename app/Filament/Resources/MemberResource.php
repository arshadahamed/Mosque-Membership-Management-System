<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers\FamiliesRelationManager;
use App\Models\Member;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class MemberResource extends Resource
{

    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-m-user';

    protected static ?string $navigationGroup = 'Members Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([

                Section::make('Personal Details')
                    ->description('Enter The Members Details')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('Name_of_Family_Head')
                            ->required()
                            ->columnSpan(3)
                            ->label('Family Head Name'),

                        Forms\Components\TextInput::make('NIC_Number')
                            ->required()
                            ->label('NIC Number')
                            ->rules(function (callable $get) {
                                $recordId = $get('id'); // get the record's ID if editing

                                // Apply unique rule for the `nic_number` field; exclude the current record when editing
                                return $recordId
                                    ? ['required', 'unique:members,NIC_Number,' . $recordId]
                                    : ['required', 'unique:members,NIC_Number'];
                            }),

                        Forms\Components\TextInput::make('Address')
                            ->required()
                            ->columnSpanFull()
                            ->label('Address'),
                        Forms\Components\TextInput::make('Land_Mobile_Number')
                            ->tel()
                            ->rules('digits:10')
                            ->columnSpan(2)
                            ->label('Landline/Mobile Number'),

                        Forms\Components\TextInput::make('WhatsApp_Number')
                            ->tel()
                            ->rules('digits:10')
                            ->columnSpan(2)
                            ->label('WhatsApp Number'),

                        Forms\Components\TextInput::make('Workplace_Address')
                            ->columnSpan(3)
                            ->label('Workplace Address'),

                        Forms\Components\TextInput::make('Workplace_Mobile_Number')
                            ->tel()
                            ->rules('digits:10')
                            ->label('Workplace Mobile Number'),

                        Forms\Components\TextInput::make('Number_of_Family_Members_Male')
                            ->numeric()
                            ->columnSpan(2)
                            ->required()
                            ->label('Number of Male Family Members'),

                        Forms\Components\TextInput::make('Number_of_Family_Members_Female')
                            ->numeric()
                            ->columnSpan(2)
                            ->required()
                            ->label('Number of Female Family Members'),
                ])->columns(4),

                Section::make('Membership')
                    ->description('Enter The Membership Details')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('Membership_fee')
                            ->numeric()
                            ->required()
                            ->label('Membership Fee'),
                        Forms\Components\TextInput::make('Account_Balance')
                            ->numeric()
                            ->required()
                            ->label('Account Balance'),

                        Forms\Components\Toggle::make('Is_Low_Income')
                            ->label('Is Low Income?')
                            ->hint('Is the family income low?')
                            ->default(false),

                        Forms\Components\DatePicker::make('Registered_Date')
                            ->required()
                            ->label('Registered Date'),

                        Forms\Components\Select::make('Status')
                            ->options([
                                '1' => 'Active',
                                '0' => 'Inactive',
                            ])
                            ->required()
                            ->label('Status'),
                    ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('Name_of_Family_Head')
                    ->label('Name of Family Head')
                    ->sortable()
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('NIC_Number')
                    ->label('NIC Number')
                    ->sortable()
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('Address')
                    ->label('Address'),

                Tables\Columns\TextColumn::make('Membership_fee')
                    ->label('Membership Fee')
                    ->money('Rs.', true),

                Tables\Columns\TextColumn::make('Land_Mobile_Number')
                    ->label('Land/Mobile Number'),

                Tables\Columns\TextColumn::make('WhatsApp_Number')
                    ->label('WhatsApp Number'),

                Tables\Columns\TextColumn::make('Workplace_Address')
                    ->label('Workplace Address'),

                Tables\Columns\TextColumn::make('Workplace_Mobile_Number')
                    ->label('Workplace Mobile Number'),

                Tables\Columns\TextColumn::make('Number_of_Family_Members_Male')
                    ->label('Male Members'),

                Tables\Columns\TextColumn::make('Number_of_Family_Members_Female')
                    ->label('Female Members'),

                Tables\Columns\TextColumn::make('Is_Low_Income')
                    ->label('Low Income'),

                Tables\Columns\TextColumn::make('Account_Balance')
                    ->label('Account Balance')
                    ->money('Rs.', true),

                Tables\Columns\TextColumn::make('Registered_Date')
                    ->label('Registered Date'),

                Tables\Columns\BooleanColumn::make('Status')
                    ->label('Status'),


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
    public static function getRelations(): array
    {
        return [
            FamiliesRelationManager::class
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }


}
