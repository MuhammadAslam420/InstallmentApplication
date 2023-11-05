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
                            <h1 class="card-title py-1"><b><strong>All Packages Table</strong></b></h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <a href="{{route('admin.add_package')}}" class="btn bg-success"><i class="fa fa-plus"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="btn bg-primary"><i class="fa fa-file-excel-o text-light"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="btn bg-info"><i class="fa fa-gift"></i></a>
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
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Month Duration</th>
                                            <th>Installment</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </div>
                                    <tbody>
                                        @forelse($packages as $package)
                                        @php
                                        $i=1;
                                        @endphp
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$package->id}}</td>
                                            <td>{{$package->name}}</td>
                                            <td>{{$package->slug}}</td>
                                            <td>{{$package->months}}</td>
                                            <td>{{ $package->min_installment }}</td>
                                            <td>{{ $package->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($package->created_at)->isoFormat("MMM Do YYYY")}}</td>
                                            <td>
                                                <a href="{{ route('admin.edit_package',['slug'=>$package->slug]) }}" class="btn bg-info"><i class="fa fa-pencil"></i></a>
                                                <a href="#" onclick="confirm('Are You Sure, You want to delete the Package!.') || event.stopImmediatePropagation()"
                                                 wire:click.prevent="deletePackage('{{ $package->id }}')" class="btn bg-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <div>
                                            <img src="{{asset('assets/img/no-record.png')}}" alt="no record found">
                                        </div>
                                        @endforelse

                                    </tbody>
                                </table>
                                {{$packages->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewire("admin.ui.footer-component")
</main>
