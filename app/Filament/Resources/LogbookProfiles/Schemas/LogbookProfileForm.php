<?php

namespace App\Filament\Resources\LogbookProfiles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LogbookProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('logbook_id')
                    ->numeric(),
                TextInput::make('chasisNumber'),
                TextInput::make('regNumber'),
                TextInput::make('CardCode'),
                TextInput::make('CardName'),
                TextInput::make('CustomerName'),
                TextInput::make('DocNum'),
                TextInput::make('Location'),
                TextInput::make('PinNo'),
                TextInput::make('IDNo'),
                DateTimePicker::make('TransFerDate'),
                TextInput::make('DocDate'),
                TextInput::make('NumAtCard'),
                TextInput::make('tel')
                    ->tel(),
                TextInput::make('LogBookFee')
                    ->numeric(),
                TextInput::make('U_ProdLine'),
                TextInput::make('EngineNumber'),
                TextInput::make('groupCode'),
                TextInput::make('groupName'),
                DateTimePicker::make('createdOn'),
                TextInput::make('createdBy'),
                DateTimePicker::make('editedOn'),
                TextInput::make('editedBy'),
                TextInput::make('status')
                    ->numeric(),
                TextInput::make('isAllocated')
                    ->numeric(),
                TextInput::make('allocatedBy')
                    ->numeric(),
                DateTimePicker::make('allocatedOn'),
                TextInput::make('isAvailable')
                    ->numeric(),
                TextInput::make('isReturned')
                    ->numeric(),
                TextInput::make('returnedBy')
                    ->numeric(),
                DateTimePicker::make('returnedOn'),
                DateTimePicker::make('packingListCreatedOn'),
                TextInput::make('packingListCreatedBy')
                    ->numeric(),
                DateTimePicker::make('allocationsCreatedOn'),
                TextInput::make('allocationsCreatedBy')
                    ->numeric(),
                DateTimePicker::make('pendingRequestsCreatedOn'),
                TextInput::make('pendingRequestsCreatedBy')
                    ->numeric(),
                DateTimePicker::make('requestsCreatedOn'),
                TextInput::make('requestsCreatedBy')
                    ->numeric(),
                DateTimePicker::make('pendingAcceptanceCreatedOn'),
                TextInput::make('pendingAcceptanceCreatedBy')
                    ->numeric(),
                DateTimePicker::make('acceptanceCreatedOn'),
                TextInput::make('acceptanceCreatedBy')
                    ->numeric(),
                DateTimePicker::make('issuesCreatedOn'),
                TextInput::make('issuesCreatedBy')
                    ->numeric(),
                DateTimePicker::make('dispatchCreatedOn'),
                TextInput::make('dispatchCreatedBy')
                    ->numeric(),
                TextInput::make('dispatchedDate'),
                TextInput::make('dispatchedBy'),
                TextInput::make('dispatchedTo'),
                TextInput::make('dispatchedYear'),
                TextInput::make('applicationNumber'),
                TextInput::make('dealer_location'),
                TextInput::make('data_source'),
                TextInput::make('ItemCode'),
            ]);
    }
}
