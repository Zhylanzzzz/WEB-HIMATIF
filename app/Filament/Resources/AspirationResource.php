<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AspirationResource\Pages;
use App\Models\Aspiration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AspirationResource extends Resource
{
    protected static ?string $model = Aspiration::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Aspirasi Masuk';

    public static function canCreate(): bool { return false; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('tracking_code')->label('Kode Tracking')->readOnly(),
            Forms\Components\TextInput::make('sender_name')->label('Pengirim')->readOnly(),
            Forms\Components\TextInput::make('email')->label('Email')->readOnly(),
            Forms\Components\TextInput::make('category')->label('Kategori')->readOnly(),
            Forms\Components\Textarea::make('message')->label('Pesan Aspirasi')->readOnly()->columnSpanFull(),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending (Menunggu)',
                    'process' => 'Diproses',
                    'completed' => 'Selesai',
                    'rejected' => 'Ditolak',
                ])->required(),
            Forms\Components\Textarea::make('admin_response')
                ->label('Tanggapan Admin')
                ->placeholder('Tulis progres atau jawaban untuk pengirim...')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('tracking_code')->label('Kode')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Waktu')->sortable(),
            Tables\Columns\TextColumn::make('sender_name')->label('Pengirim')->default('Anonim'),
            Tables\Columns\TextColumn::make('category')->label('Kategori'),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'primary' => 'process',
                    'success' => 'completed',
                    'danger' => 'rejected',
                ]),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\EditAction::make()->label('Proses / Tanggapi'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListAspirations::route('/')];
    }
}
