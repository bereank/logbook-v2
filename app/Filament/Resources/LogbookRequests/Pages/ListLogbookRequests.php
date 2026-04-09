<?php

namespace App\Filament\Resources\LogbookRequests\Pages;

use App\Filament\Resources\LogbookRequests\LogbookRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLogbookRequests extends ListRecords
{
    protected static string $resource = LogbookRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
