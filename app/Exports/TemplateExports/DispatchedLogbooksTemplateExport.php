<?php

namespace App\Exports\TemplateExports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DispatchedLogbooksTemplateExport implements FromCollection, WithHeadings
{


    public function __construct()
    {
   
    }

    public function collection()
    {
      
    }

    public function headings(): array
    {
        return [
            'chasis_number', 'reg_number','dispatched_date','dispatched_to','year','status'
        ];
    }
}
