<?php

namespace App\Console\Commands;

use App\Actions\LogbookActions\GetChasisInfoAction;
use App\Actions\LogbookActions\ProcessFailedAllocationsAction;
use App\Enums\LogBookStatusEnum;
use App\Models\LogbookProfile;
use App\Models\UploadedDataLog;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


#[Signature('app:test')]
#[Description('Test command for processing logbook actions')]
class TestCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
       // $user = Auth::loginUsingId(12);

        $totalWithIssues = LogbookProfile::where('status', LogBookStatusEnum::WITH_ISSUES->value)
            ->doesntHave('request')
            ->update([
                'status' => LogBookStatusEnum::PENDING->value,
            ]);

       
        dd($totalWithIssues);

  
    }
}
