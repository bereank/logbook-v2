<?php

namespace App\Actions\LogbookActions;

use App\Services\BridgeServiceProvider;
use Carbon\Carbon;

class SyncChasisSalesDataAction
{

    public function __construct(protected string $date)
    {
        $this->date = $date;
    }

    function handle()
    {

        $date = $this->date;

        $payload = [
            'date' => $date
        ];

        $chasisInfo = (new BridgeServiceProvider())->postData('/get-logbook-data', $payload);

        return $chasisInfo;

    }
}
