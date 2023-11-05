<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @livewire("admin.ui.nav-bar-component")
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Stock Item Detail</h3>
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
                                        <label for="batch_no" class="label-control">Stock Batch No<b class="text-danger">*</b></label>
                                        <input type="text" name="batch_no" id="batch_no" class="form-control" wire:model="batch_no">
                                        @error('batch_no') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="material" class="label-control">Material Type<b class="text-danger">*</b></label>
                                        <input type="text" name="material" id="material" placeholder="Cd &0, Cd 125..." class="form-control" wire:model="material">
                                        @error('material') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="label-control">Name<b class="text-danger">*</b></label>
                                        <input type="text" name="name" id="name" placeholder="Honda, Suzuki, Alto, Unique.... " class="form-control" wire:model="name" wire:keyup="slugGenrate">
                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug" class="label-control">Slug(Auto Generate)<b class="text-danger">*</b></label>
                                        <input type="text" name="slug" id="slug" class="form-control" wire:model="slug">
                                        @error('slug') <span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identity_no" class="label-control">Engine / Body No<b class="text-danger">*</b></label>
                                        <input type="text" name="identity_no" id="identity_no" class="form-control" wire:model="identity_no">
                                        @error('identity_no') <span class="error">{{$message}}</span>@enderror
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
