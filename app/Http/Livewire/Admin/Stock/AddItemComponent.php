<?php

namespace App\Http\Livewire\Admin\Stock;

use Livewire\Component;
use App\Models\Item;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;

class AddItemComponent extends Component
{
    use LivewireAlert;
    public $batch;
    public $user_id;
    public $batch_date;
    public $qty;
    public $invoice_price;
    protected $rules=[
          'batch'=>'required',
          'batch_date'=>'required',
          'qty'=>'required',
          'invoice_price'=>'required'
    ];
    public function addStock()
    {
        $this->validate();
        try{

        $item=new Item();
        $item->batch_no=$this->batch;
        $item->batch_date=$this->batch_date;
        $item->sell_qty=0;
        $item->remaining_qty=$this->qty;
        $item->invoice_item=$this->invoice_price;
        $item->user_id=Auth::user()->id;
        $item->qty=$this->qty;
        $item->save();
        $this->alert('success','Stock Has been added successfully');
        }catch(\Exception $e)
        {
            $this->alert('error',$e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.stock.add-item-component')->layout('layouts.base');
    }
}
