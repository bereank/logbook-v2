<?php

namespace App\Actions\LogbookActions\HelperActions;

use App\Actions\LogbookActions\GetChasisInfoAction;
use App\Models\LogbookProfile;

class UpdateLogbookFeeAction
{
    public function __construct(protected LogbookProfile $logbookProfile)
    {
        $this->logbookProfile = $logbookProfile;
    }

    public function handle()
    {

        
        $logbook = $this->logbookProfile;

        $logbookInfo = (new GetChasisInfoAction($logbook->chasisNumber))->handle();

        if (!$logbookInfo) {
            return false;
        }

        if ($logbook->LogBookFee === $logbookInfo['LogBookFee']) {
            return true;
        }

        $logbook->update([
            'LogBookFee' => $logbookInfo['LogBookFee'],
        ]);

        return true;



    }
}
