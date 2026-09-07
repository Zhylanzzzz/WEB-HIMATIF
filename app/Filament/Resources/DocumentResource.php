<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?string $navigationLabel = 'Download Center';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Judul Dokumen / Modul')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('category')
                ->label('Kategori')
                ->options([
                    'Bank Soal' => 'Bank Soal Ujian',
                    'Modul' => 'Modul Pembelajaran',
                    'Template' => 'Template Surat / Proposal',
                    'Legalitas' => 'AD/ART & SK Pengurus',
                    'Lainnya' => 'Lain-lain',
                ])
                ->required(),
            Forms\Components\FileUpload::make('file_path')
                ->label('File Berkas (PDF, ZIP, DOCX)')
                ->directory('documents')
                ->preserveFilenames()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
            Tables\Columns\TextColumn::make('category')->label('Kategori')->badge(),
            Tables\Columns\TextColumn::make('download_count')->label('Diunduh')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Tanggal Upload'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
