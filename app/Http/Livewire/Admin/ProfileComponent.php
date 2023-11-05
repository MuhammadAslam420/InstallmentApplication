<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfileComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $name;
    public $email;
    public $mobile;
    public $pic;
    public $new_pic;
    public function mount()
    {
        $user=User::find(Auth::user()->id);
        $this->name=$user->name;
        $this->email = $user->email;
        $this->mobile=$user->mobile;
        $this->pic = $user->profile_photo_path;

    }

    public function updateProfile()
    {
        try{
            $user = User::find(Auth::user()->id);
            $user->name=$this->name;
            $user->email=$this->email;
            $user->mobile=$this->mobile;
            if ($this->new_pic) {


                $imgName = Carbon::now()->timestamp . '.' . $this->new_pic->extension();
                $this->new_pic->storeAs('assets/img', $imgName);
                //dd($imgName);
                $user->profile_photo_path = $imgName;
            }
            $user->save();
            $this->alert('success','Profile has been updated successfully');
        }catch(\exception $e){
            $this->alert('error',$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.profile-component')->layout('layouts.base');
    }
}
