<?php

namespace App\Filament\Resources\LogbookRequests\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LogbookRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
             
            ]);
    }
}
