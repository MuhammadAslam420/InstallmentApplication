<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\ProfileComponent;
use App\Http\Livewire\Admin\ResetPasswordComponent;
use App\Http\Livewire\Admin\Users\AllUsersComponent;
use App\Http\Livewire\Admin\Users\RegisterComponent;
use App\Http\Livewire\Admin\Users\UserDetailComponent;
use App\Http\Livewire\Admin\Users\UserEditComponent;
use App\Http\Livewire\Admin\Users\NewPaymentComponent;
use App\Http\Livewire\Admin\Users\UserInstallmentPendingComponent;
use App\Http\Livewire\Admin\Types\PackagesTypeComponent;
use App\Http\Livewire\Admin\Types\AddPackageComponent;
use App\Http\Livewire\Admin\Types\EditPackageComponent;
use App\Http\Livewire\Admin\Stock\AllItemComponent;
use App\Http\Livewire\Admin\Stock\AddItemComponent;
use App\Http\Livewire\Admin\Stock\Item\AddStockItemComponent;
use App\Http\Livewire\Admin\Stock\Item\StockDetailComponent;
use App\Http\Livewire\Admin\Stock\Item\AssignItemComponent;
use App\Http\Livewire\Users\AllTransactionsComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route("login");
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
   Route::get("/dashboard",AdminDashboardComponent::class)->name("admin.dashboard");
   Route::get("/admin/user/register",RegisterComponent::class)->name("admin.register");
   Route::get("/admin/edit/user/{id}",UserEditComponent::class)->name("admin.edit_user");
   Route::get("/admin/user/detail/{id}",UserDetailComponent::class)->name("admin.detail_user");
   Route::get("admin/all/users",AllUsersComponent::class)->name("admin.users");
   Route::get('admin/users/export/', [AllUsersComponent::class, 'exportUsers'])->name('admin.export');
    Route::get('admin/users/export/pdf', [AllUsersComponent::class, 'exportPdf'])->name('admin.users_pdf');
    Route::get('admin/user/pdf/{id}', [AllUsersComponent::class, 'singleUserPdf'])->name('admin.single_user_pdf');
   Route::get('/admin/all/packages',PackagesTypeComponent::class)->name('admin.all_packages');
   Route::get('/admin/add/package',AddPackageComponent::class)->name('admin.add_package');
   Route::get('/admin/edit/package/{slug}',EditPackageComponent::class)->name('admin.edit_package');
   Route::get('/admin/manage/stock',AllItemComponent::class)->name('admin.all_items');
   Route::get('/admin/add/stock',AddItemComponent::class)->name('admin.add_item');
   Route::get('/admin/add/stock/item/{batch_no}',AddStockItemComponent::class)->name('admin.add_stock_item');
   Route::get('/admin/stock/detail/{stock_id}',StockDetailComponent::class)->name('admin.stock_detail');
   Route::get('/admin/assign/bike/{id}',AssignItemComponent::class)->name('admin.assign_item');
   Route::get('/admin/add/payment/{id}',NewPaymentComponent::class)->name('admin.add_payment');
   Route::get('/admin/print/invoice/{id}',[NewPaymentComponent::class,'printInvoice'])->name('admin.invoice');
   Route::get('admin/transactions/history',AllTransactionsComponent::class)->name('admin.transactions');
   Route::get('admin/all/transaction/pdf/{start_date}/{end_date}', [AllTransactionsComponent::class,'genPdf'])->name('admin.download');
   Route::get('/admin/profile',ProfileComponent::class)->name('admin.profile');
   Route::get('/admin/reset/password',ResetPasswordComponent::class)->name('admin.reset_password');
   Route::get('/admin/users/pending/installment',UserInstallmentPendingComponent::class)->name('admin.users_pending');

});
