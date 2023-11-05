   <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
       <!-- Navbar -->
       @livewire("admin.ui.nav-bar-component")
       <!-- End Navbar -->
       <section class="py-2">
           <div class="container">
               <div class="row d-flex justify-content-center align-items-center h-100">
                   <div class="col-md-12">
                       <div class="card" style="border-radius: 15px;">
                           <div class="card-body p-4">
                               <div class="d-flex text-black">
                                   <div class="flex-shrink-0">
                                       <img src="{{asset('assets/img')}}/{{$user->profile_photo_path}}" alt="Generic placeholder image" class="img-fluid" style="width:120px; border-radius:91px;">
                                   </div>
                                   <div class="flex-grow-1 ms-3">
                                       <h5 class="mb-1">{{$user->name}}</h5>
                                       <!-- <p class="mb-2 pb-1" style="color: #2b2a2a;">{{$user->utype}}</p> -->
                                       <div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #efefef;">
                                           <div>
                                               <p class="small text-muted mb-1">Contact #</p>
                                               <p class="mb-0">{{$user->mobile}}</p>
                                           </div>
                                           <div class="px-3">
                                               <p class="small text-muted mb-1">Email</p>
                                               <p class="mb-0">{{$user->email}}</p>
                                           </div>
                                           <div>
                                               <p class="small text-muted mb-1">Rating</p>
                                               <p class="mb-0">8.5</p>
                                           </div>
                                       </div>

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-12 py-3">
                       <div class="card">
                           <div class="card-header">
                               <h1 class="card-title py-1"><b><strong>All Installment Table</strong></b></h1>

                           </div>
                           <div class="card-body">
                               <div class="table-responsive">
                                   <table class="table table-striped">
                                       <div class="thead">
                                           <tr>
                                               <th>Sr.#</th>
                                               <th>Installment Id</th>
                                               <th>Amount</th>
                                               <th>Date</th>
                                           </tr>
                                       </div>
                                       <tbody>

                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       @livewire("admin.ui.footer-component")
   </main>
