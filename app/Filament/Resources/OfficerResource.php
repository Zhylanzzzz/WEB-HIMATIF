<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficerResource\Pages;
use App\Models\Officer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfficerResource extends Resource
{
    protected static ?string $model = Officer::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Pengurus';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('position')
                ->label('Jabatan')
                ->required()
                ->maxLength(255),

            // Dropdown Pilihan Atasan Langsung untuk Pohon Struktur
            Forms\Components\Select::make('parent_id')
                ->label('Atasan Langsung')
                ->options(function ($record) {
                    // Mencegah pengurus memilih dirinya sendiri sebagai atasan
                    return Officer::when($record, fn ($query) => $query->where('id', '!=', $record->id))
                        ->pluck('name', 'id');
                })
                ->searchable()
                ->nullable()
                ->placeholder('Kosongkan jika Pengurus Puncak (misal: Ketua Umum)'),

            Forms\Components\FileUpload::make('photo')
                ->label('Foto Pengurus')
                ->image()
                ->avatar()
                ->directory('officers')
                ->maxSize(2048)
                ->required(),
            Forms\Components\TextInput::make('order_priority')
                ->label('Urutan Prioritas (1 = Tertinggi)')
                ->numeric()
                ->default(0)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('photo')->label('Foto')->circular(),
            Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
            Tables\Columns\TextColumn::make('position')->label('Jabatan')->searchable(),
            Tables\Columns\TextColumn::make('parent.name')
                ->label('Atasan')
                ->default('- Root -')
                ->searchable(),
            Tables\Columns\TextColumn::make('order_priority')->label('Urutan')->sortable(),
        ])
        ->defaultSort('order_priority', 'asc')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfficers::route('/'),
            'create' => Pages\CreateOfficer::route('/create'),
            'edit' => Pages\EditOfficer::route('/{record}/edit'),
        ];
    }
}
