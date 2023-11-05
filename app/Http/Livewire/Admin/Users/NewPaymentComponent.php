<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;
use Carbon\Carbon;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\Package;
class NewPaymentComponent extends Component
{
    use LivewireAlert;
    public $user_id;
    public $total;
    public $stock_detail_id;
    public $payment_mode;
    public $name;

    protected $rules=[
        'total'=>'required',
        'stock_detail_id'=>'required',
        'payment_mode'=>'required'
    ];
    public function mount($id)
    {
         $this->user_id=$id;
         $user=User::find($this->user_id);
         $pak=Package::find($user->package_id);
         $this->total=$pak->min_installment;
         $this->name=$user->name;
         $this->stock_detail_id=$user->stock_detail_id;

    }
    public function addTransaction()
    {
        try{
            $add=new Transaction();
            $add->user_id=$this->user_id;
            $user=User::find($this->user_id);
            $user->payment_paid=($user->payment_paid + $this->total);
            $user->remaining_payment=($user->remaining_payment - $this->total);
            $user->save();
            $add->stock_detail_id=$this->stock_detail_id;
            $add->payment_mode=$this->payment_mode;
            $add->total=$this->total;
            $add->receiver_id=Auth::user()->id;
            $add->save();
            $balance=new Balance();
            $balance->transaction_id =$add->id;
            $balance->user_id=$this->user_id;
            $balance->payment=$this->total;
            $us=Balance::where('user_id',$this->user_id)->latest('id')->first();
        //dd($us);
        if($us)
        {
                $balance->remaining_payment = ($us->remaining_payment - $this->total);
                $balance->total_payment_deposite = $us->total_payment_deposite + $this->total;
        }else
        {
                $user = User::find($this->user_id);
                $pk=Package::find($user->package_id);
                $balance->remaining_payment = ($pk->sale_price - $this->total);
                $balance->total_payment_deposite = $this->total;
        }
        $balance->save();
        $this->alert('success','Transaction reciept has been added successfuly');
        }catch(\Exception $e)
        {
            $this->alert('error',$e->getMessage());
        }

    }
    public function printInvoice($id)
    {
        $transaction=Transaction::find($id);
        $user=User::find($transaction->user_id);
        $customer = new Party([
            'name'          => $user->name,
            'phone'         => $user->mobile,
            'custom_fields' => [
                'note'        => 'Invoice Reciept',
                'Bike Registration No' => $user->batch_no,
            ],
        ]);

        $client = new Party([
            'name'          => 'The Executive Movers',
            'address'       => 'The Green Street 12',
            'code'          => $user->batch_no,
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
        $invoice = Invoice::make('receipt')
            ->series('Bike')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence($transaction->id)
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
        $transactions=Transaction::where('user_id',$this->user_id)->orderBy('id','desc')->get();
        //dd($transactions);
        return view('livewire.admin.users.new-payment-component',['transactions'=>$transactions])->layout('layouts.base');
    }
}
