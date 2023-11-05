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
                              <h1 class="card-title py-1"><b><strong>All Users Detail With Pending Installment Of This Month</strong></b></h1>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-hover">
                                      <div class="thead">
                                          <tr>
                                              <th>Sr.#</th>
                                              <th>Id</th>
                                              <th>Rider</th>
                                              <th>Bike Detail</th>
                                              <th>Bike Cost</th>
                                              <th>Paid</th>
                                              <th>Installment</th>
                                              <th>Date</th>
                                          </tr>
                                      </div>
                                      <tbody>
                                          @forelse($buyers as $user)
                                          @php
                                          $i=1;
                                          @endphp
                                          <tr>
                                              <td>{{$i++}}</td>
                                              <td>{{$user->id}}</td>
                                              <td>
                                                  <div>
                                                      <p>Name:&nbsp;<span>{{$user->name}}</span></p>
                                                      <p>Email:&nbsp;<span>{{$user->email}}</span></p>
                                                      <p>Mobile:&nbsp;<span>{{$user->mobile}}</span></p>
                                                  </div>
                                              </td>
                                              <td>
                                                  <div>
                                                      @if($user->package_id !=null)
                                                      <p>Batch:&nbsp;<span>{{$user->batch_no}}</span></p>
                                                      <p>Package:&nbsp;<span>{{$user->package->name}}</span></p>
                                                      <p>Engine No:&nbsp;<span>{{$user->m_engine_no}}</span></p>
                                                      <p>registration No:&nbsp;<span>{{$user->registration_no}}</span></p>
                                                      @else
                                                      Not take Bike Yet
                                                      @endif
                                                  </div>
                                              </td>
                                              <td>
                                                  @if($user->package_id !=null)
                                                  {{$user->package->sale_price}}
                                                  @else
                                                  0.00
                                                  @endif
                                              </td>
                                              <td>1234</td>
                                              <td>
                                                  @if($user->package_id !=null)
                                                  {{ $user->package->min_installment }}
                                                  @else
                                                  0.00
                                                  @endif
                                              </td>

                                              <td>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat("MMM Do YYYY")}}</td>
                                          
                                          </tr>
                                          @empty
                                          <div>
                                              <img src="{{asset('assets/img/no-record.png')}}" alt="no record found">
                                          </div>
                                          @endforelse

                                      </tbody>
                                  </table>
                                  {{$buyers->links()}}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      @livewire("admin.ui.footer-component")
  </main>
