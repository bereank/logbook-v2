<?php

namespace App\Console\Commands;


use App\Actions\LogbookActions\GetChasisStockDataAction;
use App\Actions\LogbookActions\SyncChasisSalesDataAction;
use App\Enums\LogBookStatusEnum;
use App\Enums\UploadProcessTypeEnum;
use App\Models\LogbookProfile;
use App\Models\LogbookRequest;
use App\Models\UploadProcessLog;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        LogbookRequest::with('profile')
            ->whereNull('status')
            ->chunkById(500, function ($requests) {
                foreach ($requests as $request) {
                    if (!$request->profile) {
                        continue;
                    }
                    Log::info('Updated Chasis: ' . $request->profile->chasisNumber);

                    $request->status = $request->profile->status;
                    $request->save();
                }
            });



        dd("Done");

        // $uploadProcessLog = UploadProcessLog::findOrFail(1530);

        // (new ProcessDirectTransferIImportmportJob($uploadProcessLog))->handle();

        // dd("Done");

        $user = Auth::loginUsingId(78);
        $chasis = ' MD625AF4XE1H14919';
        $chasisInfo = (new GetChasisStockDataAction($chasis))->handle();

        dd($chasisInfo);

        $data = (new SyncChasisSalesDataAction('20260605'))->handle();

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
