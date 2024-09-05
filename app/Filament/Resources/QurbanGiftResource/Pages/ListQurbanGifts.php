<?php

namespace App\Filament\Resources\QurbanGiftResource\Pages;

use App\Filament\Resources\QurbanGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQurbanGifts extends ListRecords
{
    protected static string $resource = QurbanGiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
