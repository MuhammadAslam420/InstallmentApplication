<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use Livewire\Component;
use App\Models\StockDetail;
use Illuminate\Support\Facades\Auth;
use jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;
use App\Models\Package;
use App\Models\Item;
class AssignItemComponent extends Component
{
    use LivewireAlert;
    public $buyer_id;
    public $stock_id;
    public $batch_no;
    public $engine_no;
    public $package_id;
    public $name;
    public $type;
    public $registration_no;
    protected $rules=[
        'buyer_id'=>'required',
        'registration_no'=>'required'
    ];
    public function mount($id)
    {
        $this->stock_id=$id;
        $stock=StockDetail::where('id',$this->stock_id)->where('assign_id',null)->first();
        $this->batch_no=$stock->batch_no;
        $this->engine_no=$stock->m_unique_no;
        $this->name=$stock->name;
        $this->type=$stock->material_type;

    }
    public function assignBike()
    {
        $this->validate();
       try{
        $stock=StockDetail::find($this->stock_id);
       $stock->assign_id=$this->buyer_id;
       $stock->save();
            $stk = Item::where('batch_no', $this->batch_no)->first();
            $stk->sell_qty = ($stk->sell_qty + 1);
            $stk->remaining_qty = ($stk->remaining_qty - 1);
            $stk->save();
       $user=User::find($this->buyer_id);
       $user->batch_no=$this->batch_no;
       $user->stock_detail_id=$this->stock_id;
       $user->package_id=$this->package_id;
       $user->material_engine_no=$this->engine_no;
       $user->registration_no=$this->registration_no;
       $pak=Package::find($this->package_id);
       $user->remaining_payment=$pak->sale_price;
       $user->save();
       $this->alert('success','Congratulation this bike has been assign successfully');
       }catch(\Exception $e)
       {
         $this->alert('error',$e->getMessage());
       }
    }
    public function render()
    {
        $users=user::where('utype','USR')->where('stock_detail_id',null)->where('package_id',null)->get();
        $packages=Package::all();
        return view('livewire.admin.stock.item.assign-item-component',['users'=>$users,'packages'=>$packages])->layout('layouts.base');
    }
}
