<?php

namespace App\Filament\Resources\LogbookRequests\Pages;

use App\Filament\Resources\LogbookRequests\LogbookRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLogbookRequest extends ViewRecord
{
    protected static string $resource = LogbookRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
