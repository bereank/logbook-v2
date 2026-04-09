<?php

namespace App\Filament\Resources\LogbookRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LogbookRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('logbook.id')
                    ->label('Logbook')
                    ->placeholder('-'),
                TextEntry::make('chasisNumber')
                    ->placeholder('-'),
                TextEntry::make('regNumber')
                    ->placeholder('-'),
                TextEntry::make('name1')
                    ->placeholder('-'),
                TextEntry::make('name2')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('modeofpayment')
                    ->placeholder('-'),
                TextEntry::make('tel1')
                    ->placeholder('-'),
                TextEntry::make('tel2')
                    ->placeholder('-'),
                TextEntry::make('IDNo')
                    ->placeholder('-'),
                TextEntry::make('PinNo1')
                    ->placeholder('-'),
                TextEntry::make('PinNo2')
                    ->placeholder('-'),
                TextEntry::make('PinNo3')
                    ->placeholder('-'),
                TextEntry::make('createdOn')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('createdBy')
                    ->placeholder('-'),
                TextEntry::make('updatedOn')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updatedBy')
                    ->placeholder('-'),
                TextEntry::make('ntsaApplicationNumber')
                    ->placeholder('-'),
                TextEntry::make('isClosed')
                    ->numeric(),
                TextEntry::make('isActive')
                    ->numeric(),
                TextEntry::make('status')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('branch')
                    ->placeholder('-'),
            ]);
    }
}
