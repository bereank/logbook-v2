<?php

namespace App\Actions\LogbookActions;

use App\Services\BridgeServiceProvider;
use Carbon\Carbon;

class GetChasisInfoAction
{

    public function __construct(protected string $chasisNumber)
    {
        $this->chasisNumber = $chasisNumber;
    }

    function handle()
    {

        $chasisNumber = $this->chasisNumber;

        $payload = [
            'chasisNumber' => $chasisNumber
        ];

        $chasisInfo = (new BridgeServiceProvider())->postData('/chasis-sales-info', $payload);

        return $chasisInfo;

    }
}
