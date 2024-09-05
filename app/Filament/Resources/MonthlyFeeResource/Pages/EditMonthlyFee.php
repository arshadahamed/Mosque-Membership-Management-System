<?php

namespace App\Filament\Resources\MonthlyFeeResource\Pages;

use App\Filament\Resources\MonthlyFeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonthlyFee extends EditRecord
{
    protected static string $resource = MonthlyFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
