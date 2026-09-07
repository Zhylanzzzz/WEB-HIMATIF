<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Event & Kegiatan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Judul Event')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->readOnly(),
            Forms\Components\DateTimePicker::make('event_date')
                ->label('Tanggal & Waktu')
                ->required(),
            Forms\Components\TextInput::make('location')
                ->label('Lokasi')
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'upcoming' => 'Akan Datang',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ])
                ->default('upcoming')
                ->required(),
            Forms\Components\FileUpload::make('banner')
                ->label('Banner Event')
                ->image()
                ->directory('events')
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('description')
                ->label('Deskripsi')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('banner')->label('Banner'),
            Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
            Tables\Columns\TextColumn::make('event_date')->dateTime()->label('Tanggal')->sortable(),
            Tables\Columns\TextColumn::make('location')->label('Lokasi'),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'upcoming',
                    'success' => 'completed',
                    'danger' => 'cancelled',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
