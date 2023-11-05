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
                            <h1 class="card-title py-1"><b><strong>{{ $batch }} All Items Table</strong></b></h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <a href="{{route('admin.add_stock_item',['batch_no'=>$batch])}}" class="btn bg-success"><i class="fa fa-plus">Add New Item</i></a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" wire:click.prevent="exportStockDetails" class="btn bg-primary"><i class="fa fa-file-excel-o text-light">Download Stock Item List</i></a>
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
                                            <th>Stock Batch No</th>
                                            <th>Material Type</th>
                                            <th>Buyer</th>
                                            <th>Update By</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </div>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @forelse($details as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->batch_no }}</td>
                                            <td>
                                                <div>
                                                    <p>Type:&nbsp;{{ $item->material_type }}</p>
                                                    <p>Name:&nbsp;{{ $item->name }}</p>
                                                    <p>Slug:&nbsp;{{ $item->slug }}</p>
                                                    <p>Engine No:&nbsp;{{ $item->m_unique_no }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->assign_id !=null)
                                                {{ $item->buyer->name }}
                                                @else
                                                Not Assign Yet
                                                @endif
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if($item->assign_id ===null)
                                                <a href="{{ route('admin.assign_item',['id'=>$item->id]) }}" class="btn btn-warning"><i class="fa fa-motorcycle"></i></a>
                                                @endif
                                                <a href="#" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <div>
                                            <img src="{{asset('assets/img/no-record.png')}}" alt="no record found">
                                        </div>
                                        @endforelse

                                    </tbody>
                                </table>
                                {{$details->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewire("admin.ui.footer-component")
</main>
