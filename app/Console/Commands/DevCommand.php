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


    //  $logbookInfo = (new GetChasisInfoAction('MBX0005GFTC618148'))->handle();

    // dd($logbookInfo);
    

        $user = Auth::loginUsingId(12);

        $logbookWithoutTransferFee = LogbookProfile::
            // whereDate('createdOn','>=', now()->subMonths(8))
            // ->whereDate('DocDate','>=', now()->subMonths(8))
            where('chasisNumber','MBX0005GFTC618148')
            // ->whereNotNull('regNumber')
            // ->whereIn('status', [LogBookStatusEnum::PENDING_ACCEPTANCE, LogBookStatusEnum::PENDING])
            ->get();

        
        $this->info('Found ' . $logbookWithoutTransferFee->count() . ' logbooks without transfer fee.');

      
        foreach ($logbookWithoutTransferFee as $key => $logbook) {

            $logbookInfo = (new GetChasisInfoAction($logbook->chasisNumber))->handle();

            if (!$logbookInfo) {
                $this->info('No info for: ' . $logbook->chasisNumber);
                continue;
            }
            

            $logbook->update([
                'LogBookFee' => $logbookInfo['LogBookFee'],
            ]);

            $this->comment($logbook->chasisNumber . ' updated with LogBookFee: ' . $logbookInfo['LogBookFee']);
       
        

        }


        // Mail::to(['carol.akinyi@cargen.com', 'sevanne.wesah@cargen.org'])
        //     ->bcc('devops@cargen.com')
        //     ->send(new PendingAcceptanceNotificationMail(LogBookStatusEnum::PENDING_ACCEPTANCE));

    }
}
