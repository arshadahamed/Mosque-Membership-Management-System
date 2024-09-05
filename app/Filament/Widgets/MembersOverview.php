<?php

namespace App\Filament\Widgets;

use App\Models\Family;
use App\Models\Member;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MembersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $memberCount = Member::count();
        $familyCount = Family::count();
        $totalCount = $memberCount + $familyCount;

        return [
            // Create the statistics
            Stat::make('Members', $memberCount)
                ->description('New Members that have joined')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success')
                ->chart([1, 3, 5, 10, 20, 40]),

            Stat::make('Family Members', $familyCount)
                ->description('New Family Members that have joined')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success')
                ->chart([1, 3, 5, 10, 20, 40]),

            Stat::make('Total Community', $totalCount)
                ->description('Total Members and Family Members')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success')
                ->chart([1, 3, 5, 10, 20, 40]),
        ];
    }
}
