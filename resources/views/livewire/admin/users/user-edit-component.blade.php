   <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
       <!-- Navbar -->
       @livewire("admin.ui.nav-bar-component")
       <!-- End Navbar -->
       <div class="container-fluid py-4">
           <div class="row">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Edit User {{$name}}</h3>
                       @if(Session::has("message"))
                       <div class="alert alert-success text-dark">{{Session::get("message")}}</div>
                       @endif
                   </div>
                   <div class="card-body">
                       <div class="col-md-12">
                           <form wire:submit.prevent="editUser">
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="name" class="label-control">User Name<b class="text-danger">*</b></label>
                                           <input type="text" name="name" id="name" class="form-control" wire:model="name">
                                           @error('name') <span class="error text-danger">{{$message}}</span>@enderror

                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="email" class="label-control">Email<b class="text-danger">*</b></label>
                                           <input type="text" name="email" id="email" class="form-control" wire:model="email">
                                           @error('email') <span class="error text-danger">{{$message}}</span>@enderror
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="mobile" class="label-control">Mobile<b class="text-danger">*</b></label>
                                           <input type="text" name="mobile" id="mobile" class="form-control" wire:model="mobile">
                                           @error('mobile') <span class="error text-danger">{{$message}}</span>@enderror
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label class="label-control">U-Type <b class="text-danger">*</b></label>
                                           <select name="utype" id="utype" class="form-control" wire:model="utype">
                                               <option value="">Select Utype</option>
                                               <option value="USR">User</option>
                                               <option value="INV">Investor</option>
                                               <option value="ADM">Admin</option>
                                           </select>
                                           @error('utype') <span class="error text-danger">{{$message}}</span>@enderror
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label for="profile_photo_path" class="label-control">User Image / Profile</label>
                                           <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control" wire:model="new_image">
                                           <br>
                                           @if($profile_photo_path)
                                           <img src="{{asset('assets/img')}}/{{$profile_photo_path}}" width="120" alt="">
                                           @endif
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="d-flex justify-content-end">
                                           <button type="submit" class="btn btn-success ">Update</button>
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
