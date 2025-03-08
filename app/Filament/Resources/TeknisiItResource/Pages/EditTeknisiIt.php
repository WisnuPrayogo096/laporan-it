<?php

namespace App\Filament\Resources\TeknisiItResource\Pages;

use App\Filament\Resources\TeknisiItResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeknisiIt extends EditRecord
{
    protected static string $resource = TeknisiItResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}