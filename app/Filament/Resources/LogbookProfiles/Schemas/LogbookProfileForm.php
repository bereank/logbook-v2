<?php

namespace App\Filament\Resources\LogbookProfiles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LogbookProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Logbook Profile')
           
                    ->schema([
                        TextInput::make('chasisNumber')->label('Chasis Number'),
                        TextInput::make('regNumber')->label('Registration Number'),
                        TextInput::make('logBookFee')->label('Logbook Fee'),
                        TextInput::make('CardCode')->label('Customer Code'),
                        TextInput::make('CustomerName')->label('Customer Name'),
                        TextInput::make('DocNum')->label('Document Number'),
                        TextInput::make('Location')->label('Location'),
                        TextInput::make('PinNo')->label('PIN Number'),
                        TextInput::make('IDNo')->label('ID Number'),
                    ])
                    ->columnSpan('full')
                    ->columns(4)
            ]);
    }
}
