<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationProfileResource\Pages;
use App\Models\OrganizationProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrganizationProfileResource extends Resource
{
    protected static ?string $model = OrganizationProfile::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Profil Organisasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Utama')
                ->schema([
                    Forms\Components\TextInput::make('org_name')
                        ->label('Nama Organisasi')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('logo_path')
                        ->label('Logo Organisasi')
                        ->image()
                        ->directory('organization'),
                    Forms\Components\RichEditor::make('history')
                        ->label('Sejarah')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('vision')
                        ->label('Visi')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('mission')
                        ->label('Misi')
                        ->required()
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make('Kontak & Sekretariat')
                ->schema([
                    Forms\Components\TextInput::make('email')
                        ->label('Email Resmi')
                        ->email()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->label('No. WhatsApp / Telepon')
                        ->maxLength(50),
                    Forms\Components\Textarea::make('address')
                        ->label('Alamat Sekretariat')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('google_maps_embed')
                        ->label('Embed iFrame Google Maps')
                        ->columnSpanFull()
                        ->placeholder('<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'),
                ])->columns(2),

            Forms\Components\Section::make('Sosial Media Resmi')
                ->schema([
                    Forms\Components\TextInput::make('instagram')
                        ->label('Instagram URL')
                        ->placeholder('https://instagram.com/himaif_...'),
                    Forms\Components\TextInput::make('youtube')
                        ->label('YouTube URL')
                        ->placeholder('https://youtube.com/@himaif_...'),
                    Forms\Components\TextInput::make('linkedin')
                        ->label('LinkedIn URL')
                        ->placeholder('https://linkedin.com/company/...'),
                    Forms\Components\TextInput::make('github')
                        ->label('GitHub URL')
                        ->placeholder('https://github.com/...'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('logo_path')->label('Logo'),
            Tables\Columns\TextColumn::make('org_name')->label('Nama Organisasi')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('Email')->default('-'),
            Tables\Columns\TextColumn::make('phone')->label('Telepon')->default('-'),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Terakhir Diubah'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizationProfiles::route('/'),
            'create' => Pages\CreateOrganizationProfile::route('/create'),
            'edit' => Pages\EditOrganizationProfile::route('/{record}/edit'),
        ];
    }
}
