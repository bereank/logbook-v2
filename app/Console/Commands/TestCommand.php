<?php

namespace App\Console\Commands;

use App\Actions\LogbookActions\GetChasisInfoAction;
use App\Enums\LogBookStatusEnum;
use App\Enums\UploadProcessTypeEnum;
use App\Models\LogbookProfile;
use App\Models\UploadProcessLog;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

#[Signature('app:test')]
#[Description('Test command for processing logbook actions')]
class TestCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
    //    $user = Auth::loginUsingId(12);

          $data=   (new GetChasisInfoAction('MD625BF35T1D00019'))->handle();
    

      dd($data);



    $upload = UploadProcessLog::where('process_type', UploadProcessTypeEnum::PENDING_ACCEPTANCE->value)->first();

    
   $filed = Storage::disk('s3')->exists($upload->file_name);


    dd($filed);




        $totalWithIssues = LogbookProfile::withoutGlobalScopes()->where('status', LogBookStatusEnum::WITH_ISSUES->value)
            ->doesntHave('request')
            ->update([
                'status' => LogBookStatusEnum::PENDING->value,
            ]);

        
        $totalWithIssues = LogbookProfile::withoutGlobalScopes()->where('status', LogBookStatusEnum::PENDING_ACCEPTANCE->value)
            ->doesntHave('request')
            ->update([
                'status' => LogBookStatusEnum::PENDING->value,
            ]);

       
    

  
    }
}
