<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailLaporanResource\Pages;
use App\Models\DetailLaporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Livewire\WithPagination;

class DetailLaporanResource extends Resource
{
    use WithPagination;

    protected static ?string $model = DetailLaporan::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Detail Laporan';

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                TextColumn::make('nmr_laporan')->searchable()->sortable()->label('Nomor Laporan'),
                TextColumn::make('waktu_dihubungi')->dateTime()->sortable()->label('Waktu Dihubungi'),
                TextColumn::make('ruangan_unit')->searchable()->label('Ruangan/Unit'),
                TextColumn::make('petugas_pelapor')->searchable()->label('Petugas Pelapor'),
                TextColumn::make('jenis_kerusakan')->searchable()->label('Jenis Kerusakan'),
                TextColumn::make('status_laporan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Ditolak' => 'gray',
                        'Diproses' => 'warning',
                    })
                    ->label('Status'),
                TextColumn::make('petugas_it')->searchable()->label('Petugas IT'),
                TextColumn::make('waktu_selesai')->dateTime()->label('Waktu Selesai'),
            ])
            ->filters([
                SelectFilter::make('status_laporan')
                    ->options([
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                        'Diproses' => 'Diproses',
                    ])
                    ->label('Status Laporan'),
                Filter::make('waktu_dihubungi')
                    ->form([
                        DatePicker::make('from')->label('Dari'),
                        DatePicker::make('to')->label('Sampai'),
                    ])
                    ->query(
                        fn($query, $data) => $query
                            ->when($data['from'], fn($query) => $query->whereDate('waktu_dihubungi', '>=', $data['from']))
                            ->when($data['to'], fn($query) => $query->whereDate('waktu_dihubungi', '<=', $data['to']))
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('markCompleted')
                    ->label('Tandai Selesai')
                    ->requiresConfirmation()
                    ->action(function (Collection $records) {
                        $records->each->update(['status_laporan' => 'Selesai']);
                        // Emit event untuk refresh tabel
                        \Livewire\Livewire::emit('refreshTable');
                    })
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
                Tables\Actions\BulkAction::make('exportToExcel')
                    ->label('Ekspor ke Excel')
                    ->action(fn(Collection $records) => static::exportToExcel($records))
                    ->color('primary'),
                // ->icon('heroicon-o-cloud-download'),
                Tables\Actions\BulkAction::make('exportToPdf')
                    ->label('Ekspor ke PDF')
                    ->action(fn(Collection $records) => static::exportToPdf($records))
                    ->color('danger')
                // ->icon('heroicon-o-share'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetailLaporans::route('/'),
        ];
    }

    public static function exportToExcel(Collection $records): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Nomor Laporan');
        $sheet->setCellValue('B1', 'Waktu Dihubungi');
        $sheet->setCellValue('C1', 'Ruangan/Unit');
        $sheet->setCellValue('D1', 'Petugas Pelapor');
        $sheet->setCellValue('E1', 'Jenis Kerusakan');
        $sheet->setCellValue('F1', 'Status Laporan');
        $sheet->setCellValue('G1', 'Petugas IT');
        $sheet->setCellValue('H1', 'Waktu Selesai');

        // Data
        $row = 2;
        foreach ($records as $record) {
            $sheet->setCellValue('A' . $row, $record->nmr_laporan);
            $sheet->setCellValue('B' . $row, Carbon::parse($record->waktu_dihubungi)->format('d-m-Y H:i:s'));
            $sheet->setCellValue('C' . $row, $record->ruangan_unit);
            $sheet->setCellValue('D' . $row, $record->petugas_pelapor);
            $sheet->setCellValue('E' . $row, $record->jenis_kerusakan);
            $sheet->setCellValue('F' . $row, $record->status_laporan);
            $sheet->setCellValue('G' . $row, $record->petugas_it);
            $sheet->setCellValue('H' . $row, Carbon::parse($record->waktu_selesai)->format('d-m-Y H:i:s'));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="detail_laporan.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    public static function exportToPdf(Collection $records)
    {
        $data = [
            'records' => $records,
        ];

        $pdf = Pdf::loadView('exports.detail_laporan', $data);
        return $pdf->download('detail_laporan.pdf');
    }
}