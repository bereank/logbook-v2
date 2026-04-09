<?php
namespace App\Filament\Resources\LogbookProfiles\Tables;

use App\Enums\LogBookStatusEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Container\Attributes\Log;

class LogbookProfilesTable
{
    public static function configure(Table $table): Table
    {
        $isAdmin = auth()->user()?->hasAnyRole(['SuperAdmin', 'Admin']);
        $isOfficer = auth()->user()?->hasAnyRole(['SuperAdmin', 'Admin', 'RegOfficer']);
        return $table
            ->columns([



                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => LogBookStatusEnum::from($state)->label()
                    )
                    ->color(
                        fn($state) => LogBookStatusEnum::from($state)->color()
                    ),



                TextColumn::make('createdOn')
                    ->label('Created On'),
                TextColumn::make('DocDate')
                    ->date('Y-m-d')
                    ->label('SAP Doc Date')
                    ->visible(fn() => $isAdmin),

                     TextColumn::make('CardCode')
                    ->label('Customer Code')
                     ->visible(fn() => $isAdmin)
                    ->searchable(),

                TextColumn::make('CustomerName')
                    ->label('Customer Name')
                    ->searchable(),

                TextColumn::make('chasisNumber')
                    ->label('Chasis Number')
                    ->searchable(),

                TextColumn::make('regNumber')
                    ->label('Reg Number'),

                TextColumn::make('isAvailable')
                    ->label('LB Av.')
                    ->tooltip(fn($state) => $state ? 'Logbook is available' : 'Logbook is not available')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                    ->color(fn($state) => $state ? 'success' : 'warning'),

                TextColumn::make('owner_display')
                    ->label('Branch/Dealer')
                    ->getStateUsing(
                        fn($record) =>
                        $record->logbookOwner?->name ?? $record?->Location
                    )
                    ->visible(fn() => $isAdmin),

                TextColumn::make('sap_location')
                    ->label('SAP Location')
                    ->getStateUsing(
                        fn($record) => $record?->Location
                    )
                    ->visible(fn() => $isAdmin),

                TextColumn::make('LogBookFee')
                    ->numeric(decimalPlaces: 2)
                    ->alignRight()
                    ->label('Logbook Fee'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->defaultSort('pendingRequestsCreatedOn', 'desc')
            ->filters([
                SelectFilter::make('Status')
                    ->multiple()
                    ->options(LogBookStatusEnum::class)
                    ->default([
                        LogBookStatusEnum::PENDING->value,
                        LogBookStatusEnum::DEFAULT ->value,
                        LogBookStatusEnum::PENDING_ACCEPTANCE->value,
                        LogBookStatusEnum::WITH_ISSUES->value,
                        LogBookStatusEnum::ACCEPTED->value,
                    ])
                    ->label('Logbook Status'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([

            ]);
    }
}
