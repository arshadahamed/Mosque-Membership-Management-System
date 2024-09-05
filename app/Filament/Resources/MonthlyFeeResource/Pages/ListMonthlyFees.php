<?php

namespace App\Filament\Resources\MonthlyFeeResource\Pages;

use App\Filament\Resources\MonthlyFeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyFees extends ListRecords
{
    protected static string $resource = MonthlyFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
