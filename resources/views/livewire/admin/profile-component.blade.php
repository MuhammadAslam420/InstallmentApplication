   <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
       <!-- Navbar -->
       @livewire("admin.ui.nav-bar-component")
       <!-- End Navbar -->
       <div class="container-fluid py-4">
           <div class="row">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">{{Auth::user()->name}}&nbsp;Accout Type:&nbsp;{{Auth::user()->utype}}</h3>
                       @if(Session::has("message"))
                       <div class="alert alert-success text-dark">{{Session::get("message")}}</div>
                       @endif
                   </div>
                   <div class="card-body">
                       <div class="col-md-12">
                           <form wire:submit.prevent="updateProfile">
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="name" class="label-control">{{Auth::user()->utype}} Name<b class="text-danger">*</b></label>
                                           <input type="text" name="name" id="name" class="form-control" wire:model="name">
                                           @error('name') <span class="error">{{ $message }}</span> @enderror
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="email" class="label-control">Email<b class="text-danger">*</b></label>
                                           <input type="email" name="email" id="email" class="form-control" wire:model="email">
                                           @error('email') <span class="error">{{ $message }}</span> @enderror
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="mobile" class="label-control">Mobile<b class="text-danger">*</b></label>
                                           <input type="text" name="mobile" id="mobile" class="form-control" wire:model="mobile">
                                           @error('mobile') <span class="error">{{ $message }}</span> @enderror
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label for="profile_photo_path" class="label-control">User Image / Profile</label>
                                           <input type="file" name="new_pic" id="new_pic" class="form-control" wire:model="new_pic">
                                       </div>
                                       @if($new_pic)
                                       <img src="{{$new_pic->temporaryUrl()}}" width="120" alt="">
                                       @else
                                       <img src="{{asset('assets/img')}}/{{$pic}}" width="120" alt="">
                                       @endif
                                   </div>
                                   <div class="col-md-12">
                                       <div class="d-flex justify-content-end">
                                           <button type="submit" class="btn bg-success ">Update Profile</button>
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
