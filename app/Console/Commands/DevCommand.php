<?php

namespace App\Console\Commands;

use App\Actions\LogbookActions\GetChasisInfoAction;
use App\Enums\LogBookStatusEnum;
use App\Models\LogbookProfile;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

#[Signature('app:dev-command')]
#[Description('Command description')]
class DevCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {






        $user = Auth::loginUsingId(79);

        $logbookWithoutTransferFee = LogbookProfile::with('logbook')
            ->whereHas('logbook', function ($query) {
                $query->whereNotNull('regNumber');
            })
            ->whereDate('createdOn', '>=', now()->subMonths(1))
            ->whereNull('regNumber')
            ->whereNotNull('CardCode')
            ->whereIn('status', [LogBookStatusEnum::PENDING_ACCEPTANCE, LogBookStatusEnum::PENDING])
            ->get();


        $this->info('Found ' . $logbookWithoutTransferFee->count() . ' logbooks without transfer fee.');


        foreach ($logbookWithoutTransferFee as $key => $lb) {

            $lb->update([
                'regNumber' => $lb->logbook?->regNumber,
            ]);


        }


        // Mail::to(['carol.akinyi@cargen.com', 'sevanne.wesah@cargen.org'])
        //     ->bcc('devops@cargen.com')
        //     ->send(new PendingAcceptanceNotificationMail(LogBookStatusEnum::PENDING_ACCEPTANCE));

    }
}
