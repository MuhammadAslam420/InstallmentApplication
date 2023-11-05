<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use Livewire\Component;
use App\Models\StockDetail;
use Illuminate\Support\Facades\Auth;
use jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use App\Exports\StockDetailExport;
use Maatwebsite\Excel\Facades\Excel;

class StockDetailComponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $batch;
    public function mount($stock_id)
    {
        $this->batch=$stock_id;
    }
    public function exportStockDetails()
    {
        //return Excel::download(new UserExport, 'users.xlsx');
        try{
            return Excel::download(new StockDetailExport, 'stock_detailss.xlsx');
           // $this->alert('success','success');
        }
        catch(\Exception $e)
        {
            $this->alert('error',$e->getMessage());
        }
    }
    public function render()
    {
        $details=StockDetail::where('batch_no',$this->batch)->orderBy('id','desc')->paginate(12);
        return view('livewire.admin.stock.item.stock-detail-component',['details'=>$details])->layout('layouts.base');
    }
}
