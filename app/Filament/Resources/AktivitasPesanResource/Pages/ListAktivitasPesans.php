<?php

namespace App\Filament\Resources\AktivitasPesanResource\Pages;

use App\Filament\Resources\AktivitasPesanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAktivitasPesans extends ListRecords
{
    protected static string $resource = AktivitasPesanResource::class;
    protected static ?string $title = 'Aktivitas Pesan';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}