<?php

namespace App\Exports;

use App\Models\StockDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class StockDetailExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
  
    public function collection(): Collection
    {
        $items = StockDetail::select('id', 'batch_no', 'material_type', 'name', 'm_unique_no', 'assign_id', 'user_id', 'created_at', 'updated_at')
        ->leftJoin('users as customers', 'stock_details.assign_id', '=', 'customers.id')
        ->leftJoin('users as operators', 'stock_details.user_id', '=', 'operators.id')
        ->select('stock_details.*', 'customers.name as customer_name', 'operators.name as operator_name')
        ->get();
    
        return $items;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Batch Number',
            'Material Type',
            'Bike Name',
            'Material Unique Number',
            'Engine.No',
            'Item Entry Date',
            'Item Exit Date',
            'Rider',
            'Dispatcher'
        ];
    }
}
