<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Hash;
class ResetPasswordComponent extends Component
{
    use LivewireAlert;
    public $current_password;
    public $password;
    public $password_confirmation;
    protected $rules=[
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
    ];
    public function resetPassword()
    {
        $this->validate();
        try{
            if (Hash::check($this->current_password, Auth::user()->password)) {
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($this->password);
                $user->save();
                $this->alert('success', 'Password has been updated successfully');
                $this->reset();
            } else {
                $this->alert('error', 'password does not matched');
            }

        }catch(\Exception $e){
            $this->alert('error',$e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.reset-password-component')->layout('layouts.base');
    }
}
