<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
class UserDetailComponent extends Component
{
    public $user_id;
    public function mount($id)
    {
        $this->user_id=$id;
    }
    public function render()
    {
        $user=User::find($this->user_id);
        return view('livewire.admin.users.user-detail-component',['user'=>$user])->layout("layouts.base");
    }
}
