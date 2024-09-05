<?php

namespace App\Filament\Resources\IncomesResource\Pages;

use App\Filament\Resources\IncomesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncomes extends EditRecord
{
    protected static string $resource = IncomesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
