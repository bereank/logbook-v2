<?php

namespace App\Filament\Resources\LogbookProfiles\Widgets;

use App\Enums\LogBookStatusEnum;
use App\Filament\Resources\LogbookProfiles\Pages\ListLogbookProfiles;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class LogbookStatOverView extends StatsOverviewWidget
{
    use InteractsWithPageTable;


    protected function getTablePage(): string
    {
        return ListLogbookProfiles::class;
    }

       public function getHeaderWidgetsColumns(): int|array
    {
        return 4;
    }
    protected function getStats(): array
    {
        return [



            Stat::make('Pending', number_format($this->getPageTableQuery()->where('status', LogBookStatusEnum::PENDING)->count()))
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->description('Pednding')
                ->color(LogBookStatusEnum::PENDING->color()),
            Stat::make('Pending Acceptance', number_format($this->getPageTableQuery()->where('status', LogBookStatusEnum::PENDING_ACCEPTANCE)->count()))
                ->descriptionIcon('heroicon-m-clock')
                ->description('Pending Acceptance')
                ->color(LogBookStatusEnum::PENDING_ACCEPTANCE->color()),
            Stat::make('With Issues', number_format($this->getPageTableQuery()->where('status', LogBookStatusEnum::WITH_ISSUES)->count()))
                ->descriptionIcon('heroicon-m-x-circle')
                ->description('With Issues')
                ->color(LogBookStatusEnum::WITH_ISSUES->color()),
            Stat::make('Accepted', number_format($this->getPageTableQuery()->where('status', LogBookStatusEnum::ACCEPTED)->count()))
                ->descriptionIcon('heroicon-m-check-badge')
                ->description('Accepted')
            //     ->color(LogBookStatusEnum::ACCEPTED->color()),
            // Stat::make('Dispatched', number_format($this->getPageTableQuery()->where('status', LogBookStatusEnum::DISPATCHED)->count()))
            //     ->descriptionIcon('heroicon-m-truck')
            //     ->description('Dispatched')
            //     ->color(LogBookStatusEnum::DISPATCHED->color()),

        ];
    }
}
