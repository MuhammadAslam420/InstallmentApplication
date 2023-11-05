   <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
       <!-- Navbar -->
       @livewire("admin.ui.nav-bar-component")
       <!-- End Navbar -->
       <div class="container-fluid py-4">
           <div class="row">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">{{Auth::user()->name}}&nbsp;Accout Type:&nbsp;{{Auth::user()->utype}}</h3>
                   </div>
                   <div class="card-body">
                       <div class="col-md-12">
                           <form class="form form-horizontal" wire:submit.prevent="resetPassword">
                               <div class="form-group">
                                   <label for="" class=" control-label">Current Password</label>

                                   <div class="">
                                       <input type="password" placeholder="Current Password" class="form-control input-md" name="current_password" wire:model="current_password">
                                       @error('current_password') <div class="alert alert-danger">{{$message}}</div>@enderror
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label for="" class=" control-label">New Password</label>



                                   <div class="">
                                       <input type="password" placeholder="New Password" class="form-control input-md" name="password" wire:model="password">
                                       @error('password') <div class="alert alert-danger">{{$message}}</div>@enderror

                                   </div>
                               </div>
                               <div class="form-group">
                                   <label for="" class=" control-label">Confirm Password</label>


                                   <div class="">
                                       <input type="password" placeholder="Confirm Password" class="form-control input-md" name="password_confirmation" wire:model="password_confirmation">
                                       @error('password_confirmation') <div class="alert alert-danger">{{$message}}</div>@enderror

                                   </div>
                               </div>
                               <div class="form-group">

                                       <button type="submit" class="btn bg-success">Change Password</button>

                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
           @livewire("admin.ui.footer-component")
       </div>
   </main>
