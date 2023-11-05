<?php

namespace App\Http\Livewire\Admin\Types;

use Livewire\Component;
use App\Models\Package;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
class EditPackageComponent extends Component
{
    use LivewireAlert;
    public $name;
    public $slug;
    public $months;
    public $min_installment;
    public $status;
    public $p_slug;
    protected $rules=[
        'name'=>'required',
        'slug'=>'required',
        'months'=>'required',
        'min_installment'=>'required',
        'status'=>'required'
    ];
    public function mount($slug)
    {
        $this->p_slug=$slug;
        $package=Package::where('slug',$slug)->first();
        $this->name=$package->name;
        $this->slug=$package->slug;
        $this->months=$package->months;
        $this->min_installment=$package->min_installment;
        $this->status=$package->status;
    }
    public function generateslug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    public function addPackage()
    {
        $this->validate();
      try{
        $package=Package::where('slug',$this->p_slug)->first();
        $package->name=$this->name;
        $package->slug=$this->slug;
        $package->months=$this->months;
        $package->min_installment=$this->min_installment;
        $package->status=$this->status;
        $package->save();
        $this->alert('success','Package has been edit/updated Successfully');
      }
      catch(\Exception $e)
      {
        $this->alert('error',$e->getMessage());
      }
    }
    public function render()
    {
        return view('livewire.admin.types.edit-package-component')->layout('layouts.base');
    }
}
