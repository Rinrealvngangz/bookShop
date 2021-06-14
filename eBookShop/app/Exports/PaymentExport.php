<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\payments;
class PaymentExport implements FromCollection ,WithHeadings
{
    public function headings():array{
        return ['id',
                'thanh_vien',
                'money',
                'note',
                'vnp_response_code',
                'code_vnpay',
                 'code_bank',
               'time'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  payments::all();
    }
}
