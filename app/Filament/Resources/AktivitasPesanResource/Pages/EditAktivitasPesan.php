<?php

namespace App\Filament\Resources\AktivitasPesanResource\Pages;

use App\Filament\Resources\AktivitasPesanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAktivitasPesan extends EditRecord
{
    protected static string $resource = AktivitasPesanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}