<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @livewire("admin.ui.nav-bar-component")
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Stock</h3>
                    <div class="float-right">
                        <a href="{{route('admin.all_items')}}" class="btn bg-success"><i class="fa fa-gift p-2"></i>Back To Stock</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form wire:submit.prevent="addStock">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="batch" class="label-control">Stock Batch No<b class="text-danger">*</b></label>
                                        <input type="text" batch="batch" id="batch" class="form-control" wire:model="batch">
                                        @error('batch') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="batch_date" class="label-control">Batch Date<b class="text-danger">*</b></label>
                                        <input type="date" name="batch_date" id="batch_date" class="form-control" wire:model="batch_date">
                                        @error('batch_date') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="qty" class="label-control">Item Qty<b class="text-danger">*</b></label>
                                        <input type="text" name="qty" id="qty" class="form-control" wire:model="qty">
                                        @error('qty') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="invoice_price" class="label-control">Item Invoice Price<b class="text-danger">*</b></label>
                                        <input type="text" name="invoice_price" id="invoice_price" class="form-control" wire:model="invoice_price">
                                        @error('invoice_price') <span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success bg-primary">Add New Stock</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @livewire("admin.ui.footer-component")
    </div>
</main>
