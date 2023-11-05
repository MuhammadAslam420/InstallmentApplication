<?php

namespace App\Exports;

use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemStockExport implements FromCollection, WithHeadings 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection():Collection
    {
        return Item::select('id','batch_no','batch_date','invoice_item','qty','sell_qty','remaining_qty','created_at')
        ->leftjoin('users as users','items.user_id','=','users.id')
        ->select('items.*','users.name as user_name')->get();
    }
    public function headings():array
    {
     return [
        'Sr.No',
        'Batch.No',
        'Batch Date',
        'Sale Qty',
        'Remaining Qty',
        'Per Item Invoice Price',
        'User Id',
        'Stock Total Qty',
        'Stock Add Date In System',
        'Stock Updated Date In System',
        'Stock Manage By'
     ];  
    }
   
}
