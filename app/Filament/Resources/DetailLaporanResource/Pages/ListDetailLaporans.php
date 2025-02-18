<?php

namespace App\Filament\Resources\DetailLaporanResource\Pages;

use App\Filament\Resources\DetailLaporanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailLaporans extends ListRecords
{
    protected static string $resource = DetailLaporanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}