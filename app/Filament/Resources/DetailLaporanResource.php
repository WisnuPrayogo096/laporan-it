<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailLaporanResource\Pages;
use App\Models\DetailLaporan;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Livewire\WithPagination;
use App\Filament\Exports\DetailLaporanExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Illuminate\Database\Eloquent\Builder;
use PhpParser\Node\Stmt\Label;

class DetailLaporanResource extends Resource
{
    use WithPagination;

    protected static ?string $model = DetailLaporan::class;
    protected static ?string $navigationGroup = 'Features';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Detail Laporan';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nmr_laporan')
                    ->label('Nomor laporan')
                    ->required()
                    ->readOnly(),
                DateTimePicker::make('waktu_dihubungi')
                    ->required()
                    ->readOnly(),
                TextInput::make('ruangan_unit')
                    ->required()
                    ->maxLength(20),
                TextInput::make('petugas_pelapor')
                    ->required()
                    ->maxLength(20),
                TextInput::make('jenis_kerusakan')
                    ->required()
                    ->maxLength(20),
                Textarea::make('permasalahan')
                    ->required()
                    ->maxLength(65535),
                Textarea::make('tindakan')
                    ->maxLength(65535),
                DateTimePicker::make('waktu_selesai')
                    ->readOnly(),
                Select::make('kriteria')
                    ->options([
                        'Internal' => 'Internal',
                        'Membutuhkan Vendor' => 'Membutuhkan Vendor'
                    ]),
                TextInput::make('waktu_pengerjaan')
                    ->readOnly(),
                Select::make('petugas_it')
                    ->label('Petugas IT')
                    ->relationship('petugasIT', 'nama_petugas_it'),
                TextInput::make('nomor_pelapor')
                    ->readOnly(),
                Select::make('status_laporan')
                    ->options([
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                        'Diproses' => 'Diproses',
                    ])
                    ->required(),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->deferLoading()
            ->heading('Detail Laporan Helpdesk IT')
            ->description('Daftar seluruh laporan permasalahan IT yang telah diajukan')
            ->headerActions([
                ExportAction::make()
                ->exporter(DetailLaporanExporter::class)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_laporan', 'Selesai'))
                ->label('Export All')
                ->icon('heroicon-o-arrow-down-tray')
            ])
            ->defaultSort('waktu_dihubungi', 'desc')
            ->columns([
                TextColumn::make('nmr_laporan')
                    ->searchable()
                    ->sortable()
                    ->label('Nomor Laporan'),
                TextColumn::make('waktu_dihubungi')
                    ->dateTime()
                    ->sortable('desc')
                    ->label('Waktu Dihubungi'),
                TextColumn::make('ruangan_unit')
                    ->searchable()
                    ->label('Ruangan/Unit')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(),
                TextColumn::make('petugas_pelapor')
                    ->label('Petugas Pelapor')
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jenis_kerusakan')
                    ->label('Jenis Kerusakan')
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('permasalahan')
                    ->label('Permasalahan')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tindakan')
                    ->label('Tindakan')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('waktu_selesai')
                    ->dateTime()
                    ->label('Waktu Selesai')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kriteria')
                    ->label('Kriteria')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('waktu_pengerjaan')
                    ->time()
                    ->label('Durasi Pengerjaan')
                    ->alignCenter()
                    ->placeholder('00:00:00'),
                TextColumn::make('petugas_it')
                    ->searchable()
                    ->sortable()
                    ->label('Petugas IT')
                    ->placeholder('Belum di tindak lanjut.'),
                TextColumn::make('nomor_pelapor')
                    ->label('Nomor Pelapor')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status_laporan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Ditolak' => 'gray',
                        'Diproses' => 'warning',
                    })
                    ->label('Status'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->modal(),
                    EditAction::make(),
                ])->icon('heroicon-m-ellipsis-horizontal'),
            ])
            ->groups([
                'status_laporan',
                'petugas_it'
            ])
            ->toggleColumnsTriggerAction(
                fn (Action $action) => $action
            )
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
                ],layout: FiltersLayout::Modal)
            ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                        ExportBulkAction::make()
                            ->exporter(DetailLaporanExporter::class)
                            ->label('Export selected'),
                    ])
                ]
            )
            ->striped()
            ->emptyStateIcon('heroicon-o-computer-desktop')
            ->emptyStateHeading('Belum Ada Laporan')
            ->emptyStateDescription('Belum ada laporan permasalahan IT yang diajukan');

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetailLaporans::route('/'),
            // 'view' => Pages\ViewDetailLaporan::route('/{record}'),
            'edit' => Pages\EditDetailLaporan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}