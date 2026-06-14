<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Supplier / Pemasok';
    protected static ?string $pluralModelLabel = 'Supplier';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('nama_supplier')
                        ->label('Nama Supplier')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('telepon')
                        ->label('No. Telepon')
                        ->tel()
                        ->maxLength(15),
                    Forms\Components\Textarea::make('alamat')
                        ->label('Alamat')
                        ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_supplier')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('nama_supplier')->label('Nama Supplier')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('telepon')->label('Telepon'),
                Tables\Columns\TextColumn::make('alamat')->label('Alamat')->limit(50),
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
