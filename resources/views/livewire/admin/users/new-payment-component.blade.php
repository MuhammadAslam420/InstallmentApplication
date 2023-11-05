<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @livewire("admin.ui.nav-bar-component")
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Payment</h3>
                    <div>
                        <a href="{{route('admin.users')}}" class="btn btn-primary"><i class="fa fa-arrow-left"> Users</i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form wire:submit.prevent="addTransaction">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name" class="label-control">User Name<b class="text-danger">*</b></label>
                                        <input type="text" name="name" id="name" class="form-control" wire:model="name" readonly>
                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class=" col-md-2">
                                    <div class="form-group">
                                        <label for="stock_detail_id" class="label-control">Stock Id<b class="text-danger">*</b></label>
                                        <input type="text" name="stock_detail_id" id="stock_detail_id" class="form-control" wire:model="stock_detail_id" readonly>
                                        @error('stock_detail_id') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total" class="label-control">Deposite Payment<b class="text-danger">*</b></label>
                                        <input type="text" name="total" id="total" class="form-control" wire:model="total" readonly>
                                        @error('total') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="payment_mode" class="label-control">Payment Method<b class="text-danger">*</b></label>
                                        <select name="payment_mode" id="payment_mode" class="form-control" wire:model="payment_mode">
                                            <option value="" selected>Select Payment Method</option>
                                            <option value="COS">Cash On Spot</option>
                                            <option value="JC">JazzCash</option>
                                            <option value="EP">EasyPaisa</option>
                                            <option value="UP">UPaisa</option>
                                        </select>
                                        @error('payment_mode') <span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn bg-success ">Add New Payment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive mt-5">
                        <h2>Recent Payments</h2>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>ID</th>
                                    <th>Buyer</th>
                                    <th>Receiver</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->buyer->name }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->total }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td><a href="{{ route('admin.invoice',['id'=>$transaction->id]) }}" class="btn bg-warning"><i class="fa fa-file"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        @livewire("admin.ui.footer-component")
    </div>
</main>
