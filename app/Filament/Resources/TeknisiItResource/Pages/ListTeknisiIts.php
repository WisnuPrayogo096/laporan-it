<?php

namespace App\Filament\Resources\TeknisiItResource\Pages;

use App\Filament\Resources\TeknisiItResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeknisiIts extends ListRecords
{
    protected static string $resource = TeknisiItResource::class;
    protected static ?string $title = 'Daftar Teknisi IT';
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}