<?php

namespace App\Filament\Resources\OrganizationProfileResource\Pages;

use App\Filament\Resources\OrganizationProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationProfile extends EditRecord
{
    protected static string $resource = OrganizationProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
