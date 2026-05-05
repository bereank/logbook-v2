<?php

namespace App\Exports;

use App\Models\Logbook;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogsDataExport implements FromCollection, WithHeadings
{

    public $logs;

    public function __construct($logs)
    {
        // Convert array to collection
        $this->logs = $logs;
    }

    public function collection()
    {
        
        return $this->logs->map(function ($log) {
            return [
                'Created By' => $log->user->name,
                'Action' => $log->name,
                'Chasis Number' => $log->chasisNumber,
                'Registration Number' => $log->regNumber,                
                'Action Status' => $log->status,
                'Remarks' => $log->remarks,
                'Date Created' => $log->createdOn,
            ];
        });


    }

    public function headings(): array
    {
        return [
            'Created By', 
            'Action',
            'Chasis Number',  
            'Registration Number',  
            'Action Status', 
            'Remarks', 
            'Date Created', 
        ];
    }
}
