<?php

namespace App\Jobs\BulkUploads;

use App\Enums\LogBookStatusEnum;
use App\Imports\BulkTaskImports;
use App\Jobs\SendLogbookRequestPendingAcceptanceNotificationJob;
use App\Models\Logbook;
use App\Models\LogbookProfile;
use App\Models\LogbookRequest;
use App\Models\SystemStatus;
use App\Models\UploadedDataLog;
use App\Models\UploadProcessLog;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessLogbookPendingAcceptanceImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $filePath;
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected UploadProcessLog $uploadProcessLog)
    {
        $this->uploadProcessLog = $uploadProcessLog;

    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $uploadProcessLog = $this->uploadProcessLog;

        if (!Storage::disk('s3')->exists($uploadProcessLog->file_name)) {
            dd($uploadProcessLog);
        }

        try {

            $data = Excel::toArray(
                new BulkTaskImports,
                $uploadProcessLog->file_name,
                's3'
            );

        } catch (Exception $e) {

            UploadProcessLog::where('file_name', $this->filePath)
                ->update([
                    'status' => 0,
                ]);
            Log::error('Error importing file: ' . $e);

            return;
            // throw $e;
        }

        $user = User::where('id', $uploadProcessLog->user_id, )->first();

        try {




            $successfull = [];
            $failed = [];


            foreach ($data[0] as $index => $row) {



                DB::beginTransaction();

                try {

                    $chasisNumber = $row['chasis_number'];
                    $RegNumber = $row['reg_number'];
                    $status = $row['status'];
                    $application_number = $row['application_number'];

                    $logbook = LogbookProfile::where('chasisNumber', $chasisNumber)->first();



                    $systemstatus = SystemStatus::where('id', $status)->first();

                    if ($logbook) {
                        Logbook::where('chasisNumber', $chasisNumber)->update([
                            'status' => LogBookStatusEnum::PENDING_ACCEPTANCE,
                            'pendingAcceptanceCreatedOn' => now(),
                            'pendingAcceptanceCreatedBy' => $uploadProcessLog->user_id,
                        ]);


                        $logbook->update([
                            'status' => LogBookStatusEnum::PENDING_ACCEPTANCE,
                            'applicationNumber' => $application_number,
                            'pendingAcceptanceCreatedOn' => now(),
                            'pendingAcceptanceCreatedBy' => $uploadProcessLog->user_id,
                        ]);


                        $logbookRequest = LogbookRequest::where('chasisNumber', $chasisNumber)->first();

                        if ($logbookRequest && $logbookRequest->status !== LogBookStatusEnum::PENDING_ACCEPTANCE->value) {
                            $logbookRequest->update([
                                'status' => LogBookStatusEnum::PENDING_ACCEPTANCE,
                                'assign_to' => $uploadProcessLog->user_id,
                            ]);

                            SendLogbookRequestPendingAcceptanceNotificationJob::dispatch($logbookRequest)->afterCommit();
                        }

                        $successfuluploads = UploadedDataLog::create([
                            'name' => 'Pending Acceptance Upload',
                            'chasisNumber' => $chasisNumber,
                            'regNumber' => $RegNumber,
                            'status' => 'Success',
                            'remarks' => 'Pending Acceptance Successful',
                            'createdOn' => Carbon::now(),
                            'createdBy' => $uploadProcessLog->user_id,
                        ]);


                        array_push($successfull, $successfuluploads);
                    } else {

                        $faileduploads = UploadedDataLog::create([
                            'name' => $systemstatus->name,
                            'chasisNumber' => $chasisNumber,
                            'regNumber' => $RegNumber,
                            'status' => 'Failed',
                            'remarks' => 'Pending Acceptance Failed',
                            'createdOn' => Carbon::now(),
                            'createdBy' => $uploadProcessLog->user_id,
                        ]);

                        array_push($failed, $faileduploads);
                    }

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    Log::error('Error processing pending acceptance uploads: ' . $e->getMessage());
                }


                continue;
            }
        } catch (Exception $e) {


            $uploadProcessLog->update([
                'status' => 0
            ]);

            Log::error('Error importing file: ' . $e->getMessage());
        }

        $uploadProcessLog->update([
            'status' => 1
        ]);

    }
}
