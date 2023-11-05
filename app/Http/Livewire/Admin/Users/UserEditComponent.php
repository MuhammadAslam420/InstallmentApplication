<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class UserEditComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $mobile;
    public $password;
    public $utype;
    public $profile_photo_path;
    public $user_id;
    public $new_image;
    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'mobile' => 'required|min:13',
        'utype' => 'required',

    ];
    public function mount($id)
    {
      $this->user_id=$id;
      //$user=User::find($this->user_id);
      $user=User::find($id);
      $this->name=$user->name;
      $this->email=$user->email;
      $this->mobile = $user->mobile;
      $this->utype = $user->utype;
      $this->profile_photo_path=$user->profile_photo_path;
    }
    public function editUser()
    {
        $this->validate();
        $user = User::find($this->user_id);
        $user->name=$this->name;
        $user->email=$this->email;
        $user->mobile=$this->mobile;
        $user->utype=$this->utype;
        if($this->new_image)
        {
            $imgName = Carbon::now()->timestamp . '.' . $this->new_image->extension();
            $this->new_image->storeAs('assets/img', $imgName);
            //dd($imgName);
            $user->profile_photo_path = $imgName;
        }
        $user->save();
        session()->flash("message",'user has been updated successfully');

    }
    public function render()
    {
        return view('livewire.admin.users.user-edit-component')->layout("layouts.base");
    }
}
