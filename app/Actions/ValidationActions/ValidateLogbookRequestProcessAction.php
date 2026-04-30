<?php

namespace App\Actions\ValidationActions;


class ValidateLogbookRequestProcessAction
{

    public function __construct(protected string $chasisNumber)
    {
        $this->chasisNumber = $chasisNumber;
    }

    function handle():bool
    {


        return true;

    }
}
