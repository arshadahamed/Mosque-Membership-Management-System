<?php

namespace App\Filament\Resources\QurbanGiftResource\Pages;

use App\Filament\Resources\QurbanGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQurbanGift extends EditRecord
{
    protected static string $resource = QurbanGiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
