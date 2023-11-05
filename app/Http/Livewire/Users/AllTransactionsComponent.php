<?php

namespace App\Http\Livewire\Users;


use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Carbon\Carbon;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;


class AllTransactionsComponent extends Component
{
    use WithPagination;
    public $start;
    public $end;
    public $sort='desc';
    public $perpage=2;

     public function  genPdf($start_date,$end_date)
     {
        $customer = new Party([
            'name'          => 'Rider',
            'phone'         => 3106473564,
            'custom_fields' => [
                'note'        => 'Invoice Reciept',
                'Bike Registration No' => 10001,
            ],
        ]);

        $client = new Party([
            'name'          => 'The Executive Movers',
            'address'       => 'The Green Street 12',
            'code'          => 10001,
            'custom_fields' => [
                'Bike Registration No' =>' TM',
            ],
        ]);



        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $notes = implode("<br>", $notes);
        $item = (new InvoiceItem())->title('abc')->pricePerUnit(23);




        $invoice = Invoice::make('receipt')->template('custom')
        ->series($end_date)
            // ability to include translated invoice status
            // in case it was paid
            ->status($start_date)
            ->sequence(1)
            ->serialNumberFormat('{SEQUENCE}')
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('Rs')
            ->currencyCode('PKR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename('All Transaction from '.$start_date.'_'.$end_date)
            ->addItem($item)
            ->notes($notes)
            ->logo(public_path('vendor/invoices/sample-logo.png'));
            // You can additionally save generated invoice to configured disk
            //->save('public');

        // $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
     }
    public function render()
    {
        $transactions=Transaction::orderBy('created_at',$this->sort)->paginate($this->perpage);
        return view('livewire.users.all-transactions-component',['transactions'=>$transactions])->layout('layouts.base');
    }
}
