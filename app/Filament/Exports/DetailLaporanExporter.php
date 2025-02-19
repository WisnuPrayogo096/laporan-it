<?php

namespace App\Filament\Exports;

use App\Models\DetailLaporan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DetailLaporanExporter extends Exporter
{
    protected static ?string $model = DetailLaporan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('No'),
            // ExportColumn::make('nmr_laporan'),
            ExportColumn::make('waktu_dihubungi')
                ->label('Waktu dihubungi'),
            ExportColumn::make('ruangan_unit')
                ->label('Nama ruangan/Unit pelapor'),
            ExportColumn::make('petugas_pelapor')
                ->label('Petugas pelapor'),
            // ExportColumn::make('jenis_kerusakan'),
            ExportColumn::make('permasalahan')
                ->label('Permasalahan/Kerusakan'),
            ExportColumn::make('tindakan')
                ->label('Tindakan'),
            ExportColumn::make('waktu_selesai')
                ->label('Waktu selesai'),
            ExportColumn::make('kriteria')
                ->label('Kriteria'),
            ExportColumn::make('waktu_pengerjaan')
                ->label('Waktu pengerjaan'),
            ExportColumn::make('numerator'),
            ExportColumn::make('denominator'),
            ExportColumn::make('petugas_it')
                ->label('Petugas IT'),
            // ExportColumn::make('nomor_pelapor'),
            // ExportColumn::make('status_laporan'),
            // ExportColumn::make('created_at'),
            // ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your detail laporan export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}