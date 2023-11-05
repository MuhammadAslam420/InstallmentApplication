<?php

namespace App\Http\Livewire\Admin\Ui;

use Livewire\Component;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NavBarComponent extends Component
{
    public function render()
    {
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        
        // get the list of buyers who have not paid their installments for this month
        $buyers = User::where('utype', 'USR')->where('batch_no','!=','null')->whereDoesntHave('transactions', function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
            $query->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth]);
        })->count();
        return view('livewire.admin.ui.nav-bar-component',['buyers'=>$buyers])->layout('layouts.base');
    }
}
