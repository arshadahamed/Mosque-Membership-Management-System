<?php

namespace App\Filament\Widgets;

use App\Models\Incomes;
use App\Models\MonthlyFee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;
use App\Models\Member;

class AmountOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Income', 'Rs. ' . number_format(Incomes::sum('Amount'), 2))
            ->description('Total Incomes')
            ->descriptionIcon('heroicon-o-banknotes', IconPosition::Before)
            ->color('primary')
            ->icon('heroicon-o-banknotes'),
            Stat::make('Total Membership Income', 'Rs. ' . number_format(MonthlyFee::sum('Amount'), 2))
            ->description('Total Income from membership payment')
            ->descriptionIcon('heroicon-o-banknotes', IconPosition::Before)
            ->color('primary')
            ->icon('heroicon-o-banknotes'),
            Stat::make('Total Account Balance', 'Rs. ' . number_format(Member::sum('Account_Balance'), 2))
            ->description('Total Account Receivable')
            ->descriptionIcon('heroicon-o-banknotes', IconPosition::Before)
            ->color('danger')
            ->icon('heroicon-o-banknotes'),




        ];
    }
}
