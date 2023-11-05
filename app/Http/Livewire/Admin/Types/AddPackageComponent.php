<?php

namespace App\Http\Livewire\Admin\Types;

use Livewire\Component;
use App\Models\Package;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class AddPackageComponent extends Component
{
    use LivewireAlert;
    public $name;
    public $slug;
    public $months;
    public $min_installment;
    public $status;
    protected $rules=[
        'name'=>'required',
        'slug'=>'required',
        'months'=>'required',
        'min_installment'=>'required',
        'status'=>'required'
    ];
    public function generateslug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    public function addPackage()
    {
        $this->validate();
      try{
        $package=new Package();
        $package->name=$this->name;
        $package->slug=$this->slug;
        $package->months=$this->months;
        $package->min_installment=$this->min_installment;
        $package->status=$this->status;
        $package->save();
        $this->alert('success','Package has been added Successfully');
      }
      catch(\Exception $e)
      {
        $this->alert('error',$e->getMessage());
      }
    }
    public function render()
    {
        return view('livewire.admin.types.add-package-component')->layout('layouts.base');
    }
}
