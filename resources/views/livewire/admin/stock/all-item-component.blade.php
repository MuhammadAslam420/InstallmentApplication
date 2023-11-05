<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @livewire("admin.ui.nav-bar-component")
    <!-- End Navbar -->
    <section class="py-2">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-md-12 py-3">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title py-1"><b><strong>All Stock Table</strong></b></h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <a href="{{route('admin.add_item')}}" class="btn bg-success"><i class="fa fa-plus">Add Stock</i></a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" wire:click.prevent="exportStocks" class="btn bg-primary"><i class="fa fa-file-excel-o text-light">Download Stock Excel</i></a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-search />

                                        </div>
                                        <div class="col-md-4">
                                            <x-perpage />

                                        </div>
                                        <div class="col-md-4">
                                            <x-sort />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <div class="thead">
                                        <tr>
                                            <th>Sr.#</th>
                                            <th>Id</th>
                                            <th>Stock Batch Number</th>
                                            <th>Batch Date</th>
                                            <th>Qty</th>
                                            <th>Lease Qty</th>
                                            <th>Remaining qty</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </div>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @forelse($items as $item)
                                         <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->batch_no }}</td>
                                            <td>{{ $item->batch_date }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->sell_qty }}</td>
                                            <td>{{ $item->remaining_qty }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td><a href="{{ route('admin.stock_detail',['stock_id'=>$item->batch_no]) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.add_stock_item',['batch_no'=>$item->batch_no]) }}" class="btn btn-primary"><i class="fa fa-plus">&nbsp;Add Item Detail</i></a>
                                            </td>
                                         </tr>
                                        @empty
                                        <div>
                                            <img src="{{asset('assets/img/no-record.png')}}" alt="no record found">
                                        </div>
                                        @endforelse

                                    </tbody>
                                </table>
                                {{$items->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewire("admin.ui.footer-component")
</main>
