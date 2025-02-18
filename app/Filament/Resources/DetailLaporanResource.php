<?php
// app/Filament/Resources/DetailLaporanResource.php
namespace App\Filament\Resources;

use App\Filament\Resources\DetailLaporanResource\Pages;
use App\Models\DetailLaporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class DetailLaporanResource extends Resource
{
    protected static ?string $model = DetailLaporan::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Detail Laporan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nmr_laporan')
                    ->required()
                    ->maxLength(10)
                    ->label('Nomor Laporan'),

                DateTimePicker::make('waktu_dihubungi')
                    ->required()
                    ->label('Waktu Dihubungi'),

                TextInput::make('ruangan_unit')
                    ->required()
                    ->maxLength(20)
                    ->label('Ruangan/Unit'),

                TextInput::make('petugas_pelapor')
                    ->required()
                    ->maxLength(20)
                    ->label('Petugas Pelapor'),

                TextInput::make('jenis_kerusakan')
                    ->required()
                    ->maxLength(20)
                    ->label('Jenis Kerusakan'),

                Textarea::make('permasalahan')
                    ->required()
                    ->maxLength(65535)
                    ->label('Permasalahan'),

                Textarea::make('tindakan')
                    ->maxLength(65535)
                    ->label('Tindakan'),

                DateTimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai'),

                TextInput::make('kriteria')
                    ->maxLength(50)
                    ->label('Kriteria'),

                TextInput::make('waktu_pengerjaan')
                    ->label('Waktu Pengerjaan')
                    ->hint('Format: HH:MM'),

                TextInput::make('numerator')
                    ->numeric()
                    ->label('Numerator'),

                TextInput::make('denominator')
                    ->numeric()
                    ->label('Denominator'),

                Select::make('petugas_it')
                    ->relationship('petugasIT', 'nama_petugas_it')
                    ->label('Petugas IT'),

                TextInput::make('nomor_pelapor')
                    ->maxLength(20)
                    ->label('Nomor Pelapor'),

                Select::make('status_laporan')
                    ->options([
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                        'Diproses' => 'Diproses',
                    ])
                    ->required()
                    ->label('Status Laporan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nmr_laporan')
                    ->searchable()
                    ->sortable()
                    ->label('Nomor Laporan'),

                TextColumn::make('waktu_dihubungi')
                    ->dateTime()
                    ->sortable()
                    ->label('Waktu Dihubungi'),

                TextColumn::make('ruangan_unit')
                    ->searchable()
                    ->label('Ruangan/Unit'),

                TextColumn::make('petugas_pelapor')
                    ->searchable()
                    ->label('Petugas Pelapor'),

                TextColumn::make('jenis_kerusakan')
                    ->searchable()
                    ->label('Jenis Kerusakan'),

                TextColumn::make('status_laporan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Ditolak' => 'danger',
                        'Diproses' => 'warning',
                    })
                    ->label('Status'),

                TextColumn::make('petugas_it')
                    ->searchable()
                    ->label('Petugas IT'),

                TextColumn::make('waktu_selesai')
                    ->dateTime()
                    ->sortable()
                    ->label('Waktu Selesai'),
            ])
            ->filters([
                SelectFilter::make('status_laporan')
                    ->options([
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                        'Diproses' => 'Diproses',
                    ])
                    ->label('Status Laporan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetailLaporans::route('/'),
            'create' => Pages\CreateDetailLaporan::route('/create'),
            'edit' => Pages\EditDetailLaporan::route('/{record}/edit'),
        ];
    }
}