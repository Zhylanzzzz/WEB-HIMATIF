<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Galeri Kegiatan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Judul Album / Kegiatan')
                ->required(),
            Forms\Components\Select::make('event_id')
                ->label('Relasi Event (Opsional)')
                ->relationship('event', 'title')
                ->nullable()
                ->searchable(),
            Forms\Components\FileUpload::make('images')
                ->label('Foto Dokumentasi (Bisa Unggah Banyak)')
                ->multiple()
                ->image()
                ->directory('galleries')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Textarea::make('description')
                ->label('Deskripsi Singkat')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Album')->searchable(),
            Tables\Columns\TextColumn::make('event.title')->label('Event Terkait')->default('-'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Tanggal Album'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
