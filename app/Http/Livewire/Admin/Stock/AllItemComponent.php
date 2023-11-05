<?php

namespace App\Http\Livewire\Admin\Stock;

use Livewire\Component;
use App\Models\Item;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use App\Exports\ItemStockExport;
use Maatwebsite\Excel\Facades\Excel;

class AllItemComponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $search;
    public $sort='desc';
    public $perpage=2;
    public function exportStocks()
    {
        //return Excel::download(new UserExport, 'users.xlsx');
        try{
            return Excel::download(new ItemStockExport, 'stocks.xlsx');
           // $this->alert('success','success');
        }
        catch(\Exception $e)
        {
            $this->alert('error',$e->getMessage(),[
                'position' => 'center',
                'timer' => 8000,
                'toast' => true,
               ]);
        }
    }
    public function render()
    {
        $items=Item::where('batch_no','LIKE','%'.$this->search.'%')->orderBy('created_at',$this->sort)->paginate($this->perpage);
        return view('livewire.admin.stock.all-item-component',['items'=>$items])->layout('layouts.base');
    }
}
