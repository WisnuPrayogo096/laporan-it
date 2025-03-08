<?php

namespace App\Filament\Resources\DetailLaporanResource\Pages;

use App\Filament\Resources\DetailLaporanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;

class ListDetailLaporans extends ListRecords
{
    protected static string $resource = DetailLaporanResource::class;
    protected static ?string $title = 'Detail Laporan';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
    protected function paginateTableQuery(Builder $query): CursorPaginator
    {
        return $query->cursorPaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
    }
}