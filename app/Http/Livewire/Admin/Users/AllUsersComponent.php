<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Auth;
class AllUsersComponent extends Component
{
     public $search;
     public $sort='desc';
     public $perpage=10;
    use WithPagination;
    use LivewireAlert;
    public function exportUsers()
    {
        //return Excel::download(new UserExport, 'users.xlsx');
        try{
            return Excel::download(new UserExport, 'users.xlsx');
           // $this->alert('success','success');
        }
        catch(\Exception $e)
        {
            $this->alert('error',$e->getMessage());
        }
    }
    public function deleteUser($id)
    {
        try{
            $user = User::find($id);
            if($user->package_id != null)
            {
                $this->alert('error',"This user ".$user->name." can't be deleted because of the user associated with Bike");

                
            }else
            {
                $user->delete();
                $this->alert('success','User has been deleted successfully');
            }

        }catch(\Exception $e)
        {
           $this->alert('error',$e->getMessage());
        }
    }
    public function exportPdf()
    {

        //$transaction = Transaction::find($id);
        $user = User::find(Auth::user()->id);
        $customer = new Party([
            'name'          => $user->name,
            'phone'         => $user->mobile,
            'custom_fields' => [
                'note'        => 'Invoice Generator',
                'User Registration' => $user->id,
            ],
        ]);

        $client = new Party([
            'name'          => 'The Executive Movers',
            'address'       => 'The Green Street 12',
            'code'          => $user->id,
            'custom_fields' => [
                'Bike Registration No' => $user->id,
            ],
        ]);



        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $notes = implode("<br>", $notes);
        $item = (new InvoiceItem())->title($user->name)->pricePerUnit($user->id);
        $invoice = Invoice::make('receipt')->template('users')
        ->series('Bike')
        // ability to include translated invoice status
        // in case it was paid
        ->status(__('invoices::invoice.paid'))
        ->sequence($user->id)
            ->serialNumberFormat('{SEQUENCE}')
            ->seller($client)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('Rs')
            ->currencyCode('PKR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItem($item)
            ->notes($notes)
            ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        // $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();

    }
    public function singleUserPdf($id)
    {
        $user = User::find($id);
        $customer = new Party([
            'name'          => $user->name,
            'phone'         => $user->mobile,
            'custom_fields' => [
                'note'        => 'Invoice Generator',
                'Bike Registration' => $user->registration_no,
            ],
        ]);

        $client = new Party([
            'name'          => 'The Executive Movers',
            'address'       => 'The Green Street 12',
            'code'          => 'TM Name Of Trust',
            'custom_fields' => [
                'Bike Registration No' => $user->registration_no,
            ],
        ]);



        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $notes = implode("<br>", $notes);
        $item = (new InvoiceItem())->title($user->name)->pricePerUnit($user->id);
        $invoice = Invoice::make('receipt')->template('single_user')
        ->series('Bike')
        // ability to include translated invoice status
        // in case it was paid
        ->status(__('invoices::invoice.paid'))
        ->sequence($user->id)
            ->serialNumberFormat('{SEQUENCE}')
            ->seller($client)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('Rs')
            ->currencyCode('PKR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItem($item)
            ->notes($notes)
            ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        // $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
    public function render()
    {
        $users=User::where('name','LIKE','%'.$this->search.'%')->Orwhere('email', 'LIKE', '%' . $this->search . '%')->Orwhere('mobile', 'LIKE', '%' . $this->search . '%')->where('utype','USR')->orderBy('id',$this->sort)->paginate($this->perpage);
        return view('livewire.admin.users.all-users-component',['users'=>$users])->layout("layouts.base");
    }
}
