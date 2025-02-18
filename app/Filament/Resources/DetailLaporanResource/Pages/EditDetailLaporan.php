<?php

namespace App\Filament\Resources\DetailLaporanResource\Pages;

use App\Filament\Resources\DetailLaporanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailLaporan extends EditRecord
{
    protected static string $resource = DetailLaporanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
