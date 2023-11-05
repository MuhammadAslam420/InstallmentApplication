<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class RegisterComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $mobile;
    public $password;
    public $utype;
    public $profile_photo_path;

    protected $rules=[
        'name'=>'required|min:6',
        'email'=>'required|email',
        'mobile'=>'required|min:13',
        'utype'=>'required',
        'password'=>'required|min:8'
    ];


    public function AddNewUser()
    {
        $this->validate();
        //dd($this->email);
        $user=new User();
        $user->name=$this->name;
        $user->email = $this->email;
        $user->utype=$this->utype;
        $user->mobile = $this->mobile;
        $user->password =Hash::make($this->name);
        if($this->profile_photo_path)
        {


            $imgName = Carbon::now()->timestamp . '.' . $this->profile_photo_path->extension();
            $this->profile_photo_path->storeAs('assets/img', $imgName);
            //dd($imgName);
            $user->profile_photo_path = $imgName;
        }
        $user->save();
        return redirect()->route("admin.register")->with("message",'A New user has been register successfully!');

    }
    public function render()
    {
        return view('livewire.admin.users.register-component')->layout("layouts.base");
    }
}
