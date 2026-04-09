<?php

namespace App\Filament\Resources\LogbookRequests\Tables;

use App\Enums\LogBookStatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LogbookRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('profile.DocDate')
                    ->date('Y-m-d')
                    ->label('Doc Date'),


                TextColumn::make('owner_display')
                    ->label('Customer Name')
                    ->getStateUsing(
                        fn($record) =>
                        $record->profile->CustomerName ?? $record->profile->NumAtCard
                    ),



                TextColumn::make('owner_display')
                    ->label('Customer Name')
                    ->getStateUsing(
                        fn($record) =>
                        $record->profile->CustomerName ?? $record->profile?->NumAtCard ?? 'N/A'
                    ),


                TextColumn::make('branch_dealer')
                    ->label('Branch/Dealer')
                    ->getStateUsing(
                        fn($record) =>
                        $record->profile?->logbookOwner?->name ?? $record->profile?->Location ?? 'N/A'
                    ),

                TextColumn::make('chasisNumber')
                    ->copyable()
                    ->badge()
                    ->color('indigo')
                    ->searchable(),

                TextColumn::make('profile.regNumber')
                    ->label('Reg Number'),


                TextColumn::make('profile.isAvailable')
                    ->label('LB Status')
                    ->tooltip(fn($state) => $state ? 'Logbook is available' : 'Logbook is not available')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                    ->color(fn($state) => $state ? 'success' : 'warning'),


                TextColumn::make('profile.status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => LogBookStatusEnum::from($state)->label()
                    )
                    ->color(
                        fn($state) => LogBookStatusEnum::from($state)->color()
                    ),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                SelectFilter::make('profile_status')
                    ->label('Logbook Status')
                    ->multiple()
                    ->options(
                        collect(LogBookStatusEnum::cases())
                            // ->whereIn('value', [LogBookStatusEnum::PROCESSING,  LogBookStatusEnum::PENDING_ACCEPTANCE, LogBookStatusEnum::WITH_ISSUES])
                            ->mapWithKeys(fn($case) => [
                                $case->value => $case->label()
                            ])
                            ->toArray()
                    )
                    ->default([
                        LogBookStatusEnum::PROCESSING,
                        LogBookStatusEnum::PENDING_ACCEPTANCE,
                        LogBookStatusEnum::WITH_ISSUES,
                    ])
                    ->query(function ($query, array $data) {
                        if (!filled($data['values'])) {
                            return;
                        }

                        $query->whereHas('profile', function ($q) use ($data) {
                            $q->whereIn('status', $data['values']);
                        });
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
