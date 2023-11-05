<?php

namespace App\Http\Livewire\Admin;

use App\Models\Balance;
use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
class AdminDashboardComponent extends Component
{
    public function render()
    {
        // $buyers = User::whereHas('transactions', function ($query) {
        //     $query->where('created_at', '!=', date('Y-m-05'));
        // })->count();
     
        $today=Carbon::now()->today();
        //dd($today);
        $users=User::where('utype','!=','ADM')->whereDate('created_at',$today)->count();
       // dd($users);
       $user=User::where('utype','!=','ADM')->count();
       //dd($user);
       $customers=User::orderBy('created_at','desc')->take(10)->get();
       $totalusers=User::where("utype",'USR')->count();
        $totalinvestor = User::where("utype", 'INV')->count();
        $balances=Balance::select(DB::raw("(SUM(payment)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereYear('created_at', date('Y'))
        ->groupBy('monthname')
        ->get();
        //dd($balances);
        $transactions=Transaction::sum('total');
        $todaysales=Transaction::whereDate('created_at',Carbon::today())->sum('total');
        // $users = User::with(['transactions','balances','items'])->where('utype','USR')->paginate(12);
        // dd($users);
        return view('livewire.admin.admin-dashboard-component',['users'=>$users,'user'=>$user,
            'customers'=> $customers, 'totalusers'=> $totalusers, 'totalinvestor'=> $totalinvestor,
            'balances'=> $balances, 'transactions'=> $transactions, 'todaysales'=> $todaysales])->layout("layouts.base");
    }
}
