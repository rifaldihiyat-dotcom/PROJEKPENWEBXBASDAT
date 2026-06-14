<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BuahResource\Pages;
use App\Models\Buah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BuahResource extends Resource
{
    protected static ?string $model = Buah::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Data Produk Buah';
    protected static ?string $pluralModelLabel = 'Data Buah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('nama_buah')
                        ->label('Nama Buah')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('harga_jual')
                        ->label('Harga Jual per Kg')
                        ->numeric()
                        ->required()
                        ->prefix('Rp'),
                    Forms\Components\FileUpload::make('gambar')
                        ->label('Foto Buah')
                        ->image()
                        ->directory('buah-images')
                        ->columnSpanFull(),
                    Forms\Components\Select::make('id_kategori')
                        ->label('Kategori')
                        ->relationship('kategori', 'nama_kategori')
                        ->required()
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('suppliers')
                        ->label('Supplier / Pemasok')
                        ->relationship('suppliers', 'nama_supplier')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->multiple(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_buah')->label('ID')->sortable(),
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Foto')
                    ->square(),
                Tables\Columns\TextColumn::make('nama_buah')->label('Nama Buah')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('harga_jual')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('suppliers.nama_supplier')
                    ->label('Supplier Pemasok')
                    ->badge()
                    ->searchable(),
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
            'index' => Pages\ListBuahs::route('/'),
            'create' => Pages\CreateBuah::route('/create'),
            'edit' => Pages\EditBuah::route('/{record}/edit'),
        ];
    }
}
