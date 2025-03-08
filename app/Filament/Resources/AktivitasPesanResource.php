<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AktivitasPesanResource\Pages;
use App\Filament\Resources\AktivitasPesanResource\RelationManagers;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AktivitasPesanResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationGroup = 'Features';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Aktivitas Pesan';
    protected static ?int $navigationSort = 2;
    public static function table(Table $table): Table
    {
        return $table
            ->poll('2s')
            ->deferloading()
            ->heading('Riwayat Aktivitas Pesan')
            ->description('Daftar seluruh aktivitas pesan yang masuk ke dalam sistem')
            ->defaultSort('time', 'desc')
            ->columns([
                TextColumn::make('time')
                    ->datetime()
                    ->label('Time'),
                TextColumn::make('message_received')
                    ->searchable()
                    ->label('Message Received'),
            ])
            ->paginated([25])
            ->emptyStateIcon('heroicon-o-chat-bubble-left-ellipsis')
            ->emptyStateHeading('Belum Ada Aktivitas Pesan')
            ->emptyStateDescription('Belum ada aktivitas pesan yang tercatat dalam sistem');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAktivitasPesans::route('/'),
            // 'create' => Pages\CreateAktivitasPesan::route('/create'),
            // 'edit' => Pages\EditAktivitasPesan::route('/{record}/edit'),
        ];
    }
}