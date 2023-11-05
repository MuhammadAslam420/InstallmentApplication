<?php

namespace App\Http\Livewire\Admin\Types;

use Livewire\Component;
use App\Models\Package;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PackagesTypeComponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    public function deletePackage($id)
    {
       $package=Package::find($id);
       $package->delete();
       $this->alert('success','Package has been Deleted',[
        'position' => 'top-end'
       ]);
    }
    public function render()
    {
        $packages=Package::paginate(3);
        return view('livewire.admin.types.packages-type-component',['packages'=>$packages])->layout('layouts.base');
    }
}
