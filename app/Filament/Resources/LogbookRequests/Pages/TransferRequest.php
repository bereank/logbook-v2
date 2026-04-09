<?php

namespace App\Filament\Resources\LogbookRequests\Pages;

use App\Filament\Resources\LogbookRequests\LogbookRequestResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class TransferRequest extends Page
{
    use InteractsWithRecord;

    protected static string $resource = LogbookRequestResource::class;

    protected string $view = 'filament.resources.logbook-requests.pages.transfer-request';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
