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
                Select::make('logbook_id')
                    ->relationship('logbook', 'id'),
                TextInput::make('chasisNumber'),
                TextInput::make('regNumber'),
                TextInput::make('name1'),
                TextInput::make('name2'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('modeofpayment'),
                TextInput::make('tel1')
                    ->tel(),
                TextInput::make('tel2')
                    ->tel(),
                TextInput::make('IDNo'),
                TextInput::make('PinNo1'),
                TextInput::make('PinNo2'),
                TextInput::make('PinNo3'),
                DateTimePicker::make('createdOn'),
                TextInput::make('createdBy'),
                DateTimePicker::make('updatedOn'),
                TextInput::make('updatedBy'),
                TextInput::make('ntsaApplicationNumber'),
                TextInput::make('isClosed')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('isActive')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('status'),
                TextInput::make('branch'),
            ]);
    }
}
