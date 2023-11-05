<?php

namespace App\Exports;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class UserExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection():Collection
    {
        //
        return User::select('id','batch_no','stock_detail_id','package_id','material_engine_no',
        'registration_no','name','email','utype','mobile','payment_paid','remaining_payment',
        'created_at','updated_at')->where('utype','USR')->get();
    }
    public function headings(): array
    {
        return [
            'Sr No',
            'Batch No',
            'Stock ID',
            'Package ID',
            'Engine No',
            'Registration No',
            'Name',
            'Email',
            'User Type',
            'Mobile',
            'Paid Amount',
            'Remaining Amount',
            'Account Created Date',
            'Account Updated Date',
        ];
    }
}
