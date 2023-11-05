<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use Livewire\Component;
use App\Models\StockDetail;
use Illuminate\Support\Facades\Auth;
use jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use App\Models\Item;
class AddStockItemComponent extends Component
{
    use LivewireAlert;
    public $batch_no;
    public $material;
    public $name;
    public $slug;
    public $identity_no;
    public $user_id;
    public function mount($batch_no)
    {
        $this->batch_no=$batch_no;
    }
    protected $rules=[
        'batch_no'=>'required',
        'material'=>'required',
        'name'=>'required',
        'slug'=>'required',
        'identity_no'=>'required'
    ];
    public function slugGenrate()
    {
        $this->slug=Str::slug($this->name,"-");
    }
     public function addStock()
     {
        $this->validate();
        try{
            $stk=Item::where('batch_no',$this->batch_no)->first();
            $stk_count=StockDetail::where('batch_no',$this->batch_no)->count();
            //dd($stk->qty,$stk_count);
            if( $stk_count < $stk->qty)
            {
            $stock=new StockDetail();
            $stock->batch_no=$this->batch_no;
            $stock->material_type=$this->material;
            $stock->name=$this->name;
            $stock->slug=$this->slug;
            $stock->m_unique_no=$this->identity_no;
            $stock->user_id=Auth::user()->id;
            $stock->save();
            $this->alert('success','Stock has been added');
            }else{
                $this->alert('error',"You can't add more Item to this stock because It's reaches it's limit");
            }

        }catch(\Exception $e)
        {
            $this->alert('error',$e->getMessage());
        }
     }
    public function render()
    {
        return view('livewire.admin.stock.item.add-stock-item-component')->layout('layouts.base');
    }
}
