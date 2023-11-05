<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @livewire("admin.ui.nav-bar-component")
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Assign Bike</h3>
                    <div class="float-right">
                        <a href="{{route('admin.all_items')}}" class="btn bg-success"><i class="fa fa-gift p-2"></i>Back To Stock</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form wire:submit.prevent="assignBike">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="batch_no" class="label-control">Stock Batch No<b class="text-danger">*</b></label>
                                        <input type="text" name="batch_no" id="batch_no" class="form-control" wire:model="batch_no" readonly>
                                        @error('batch_no') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="label-control">Bike Name<b class="text-danger">*</b></label>
                                        <input type="text" name="name" id="name"  class="form-control" wire:model="name" readonly>
                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="label-control">Bike Model<b class="text-danger">*</b></label>
                                        <input type="text" name="type" id="type"  class="form-control" wire:model="type" readonly>
                                        @error('type') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="engine_no" class="label-control">Engine / Body No<b class="text-danger">*</b></label>
                                        <input type="text" name="engine_no" id="engine_no" class="form-control" wire:model="engine_no" readonly>
                                        @error('engine_no') <span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_no" class="label-control">bike Registration No<b class="text-danger">*</b></label>
                                        <input type="text" name="registration_no" id="registration_no" class="form-control" wire:model="registration_no">
                                        @error('registration_no') <span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="label-control">User<b class="text-danger">*</b></label>
                                        <select name="buyer_id" id="buyer_id" class="form-control" wire:model="buyer_id">
                                            <option value="" selected>Select Buyer</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('buyer_id') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug" class="label-control">Package <b class="text-danger">*</b></label>
                                        <select name="package_id" id="package_id" class="form-control" wire:model="package_id">
                                            <option value="" selected>Select Package</option>
                                            @foreach($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('package_id') <span class="error">{{$message}}</span>@enderror
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
