<?php

namespace App\Filament\Resources\LogbookProfiles\Pages;

use App\Filament\Resources\LogbookProfiles\LogbookProfileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLogbookProfile extends ViewRecord
{
    protected static string $resource = LogbookProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
     
        ];
    }
}
