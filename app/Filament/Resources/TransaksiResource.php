<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationLabel = 'Log Transaksi Stok';
    protected static ?string $pluralModelLabel = 'Transaksi Stok';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('id_buah')
                        ->label('Pilih Buah')
                        ->relationship('buah', 'nama_buah')
                        ->required()
                        ->searchable()
                        ->preload(),
                    Forms\Components\DateTimePicker::make('tgl_transaksi')
                        ->label('Tanggal & Waktu')
                        ->default(now())
                        ->required(),
                    Forms\Components\Select::make('jenis')
                        ->label('Jenis Gerakan Stok')
                        ->options([
                            'masuk' => 'Masuk (Restock / Pembelian)',
                            'keluar' => 'Keluar (Terjual / Menyusut)',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('jumlah')
                        ->label('Jumlah (Kg)')
                        ->numeric()
                        ->required()
                        ->minValue(1),
                    Forms\Components\Textarea::make('keterangan')
                        ->label('Keterangan Tambahan')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_transaksi')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('buah.nama_buah')->label('Nama Buah')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tgl_transaksi')->label('Waktu Transaksi')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'masuk' => 'success',
                        'keluar' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah (Kg)')->sortable(),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan')->limit(30),
            ])
            ->filters([])
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
