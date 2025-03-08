<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeknisiItResource\Pages;
use App\Filament\Resources\TeknisiItResource\RelationManagers;
use App\Models\PetugasIT;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeknisiItResource extends Resource
{
    protected static ?string $model = PetugasIT::class;
    protected static ?string $navigationGroup = 'Features';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Teknisi IT';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nomor_petugas')
                ->label('Nomor Telp')
                ->required(),
            TextInput::make('nama_petugas_it')
                ->label('Nama Teknisi')
                ->required()
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->poll('10s')
            ->heading('Data Teknisi IT')
            ->description('Daftar teknisi IT yang menangani permasalahan helpdesk')
            ->columns([
                TextColumn::make('id')
                    ->label('No ID'),
                TextColumn::make('nomor_petugas')
                    ->label('Nomor Telp'),
                TextColumn::make('nama_petugas_it')
                    ->label('Nama Teknisi IT'),
                TextColumn::make('jml_diproses')
                    ->label('Diproses'),
                TextColumn::make('jml_selesai')
                    ->label('Selesai'),
                TextColumn::make('jml_ditolak')
                    ->label('Ditolak'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->emptyStateIcon('heroicon-o-computer-desktop')
            ->emptyStateHeading('Belum Ada Data Teknisi')
            ->emptyStateDescription('Belum ada data teknisi IT yang terdaftar dalam sistem');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeknisiIts::route('/'),
            // 'create' => Pages\CreateTeknisiIt::route('/create'),
            'edit' => Pages\EditTeknisiIt::route('/{record}/edit'),
        ];
    }
}