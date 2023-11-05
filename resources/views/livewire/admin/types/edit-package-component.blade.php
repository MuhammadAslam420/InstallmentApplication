<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @livewire("admin.ui.nav-bar-component")
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit {{ $name }} Package</h3>
                    <div class="float-right">
                        <a href="{{route('admin.all_packages')}}" class="btn bg-success"><i class="fa fa-gift p-2"></i>Back To Packages</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form wire:submit.prevent="addPackage">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="label-control">Package Name<b class="text-danger">*</b></label>
                                        <input type="text" name="name" id="name" class="form-control" wire:model="name" wire:keyup="generateslug">
                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug" class="label-control">Slug(Auto Generated)<b class="text-danger">*</b></label>
                                        <input type="text" name="slug" id="slug" class="form-control" wire:model="slug">
                                        @error('slug') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="months" class="label-control">Month<b class="text-danger">*</b></label>
                                        <input type="text" name="months" id="months" class="form-control" wire:model="months">
                                        @error('months') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min_installment" class="label-control">Min Installment<b class="text-danger">*</b></label>
                                        <input type="text" name="min_installment" id="min_installment" class="form-control" wire:model="min_installment">
                                        @error('min_installment') <span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label-control">Status <b class="text-danger">*</b></label>
                                        <select name="status" id="status" class="form-control" wire:model="status">
                                            <option value="">Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="deactive">De-active</option>
                                        </select>
                                        @error('status') <span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success bg-info">Update</button>
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
