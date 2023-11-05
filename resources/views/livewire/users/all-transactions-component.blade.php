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
                              <h1 class="card-title py-1"><b><strong>All Transactions History</strong></b></h1>
                              <div class="row">

                                  <div class="col-md-12">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <form action="/admin/all/transaction/pdf/{{$start}}/{{$end}}">
                                                  <div class="row">
                                                      <div class="col-md-4">
                                                          <div class="form-group">
                                                              <label for="start" class="label-control">Select Start Date</label>
                                                              <input type="date" name="start" id="start" class="form-control" wire:model="start">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                          <div class="form-group">
                                                              <label for="end" class="label-control">Select End Date</label>
                                                              <input type="date" name="end" id="end" class="form-control" wire:model="end">
                                                          </div>

                                                      </div>
                                                      <div class="col-md-4">
                                                          <div class="form-group">
                                                              <label for="month" class="label-control">Click To Download</label>
                                                              <button type="submit" class="btn bg-success"><i class="fa fa-pdf"></i>Download PDF</button>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                          <div class="col-md-3">
                                              <x-sort />
                                          </div>
                                          <div class="col-md-3">
                                              <x-perpage />
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
                                              <th>TID</th>
                                              <th>Customer</th>
                                              <th>Payment</th>
                                              <th>Payment Method</th>
                                              <th>Receiver</th>
                                              <th>Date</th>
                                          </tr>
                                      </div>
                                      <tbody>
                                          @forelse($transactions as $transaction)
                                          @php
                                          $i=1;
                                          @endphp
                                          <tr>
                                              <td>{{$i++}}</td>
                                              <td>{{$transaction->id}}</td>
                                              <td>{{$transaction->buyer->name}}</td>
                                              <td>{{$transaction->total}}</td>
                                              <td>{{$transaction->payment_mode}}</td>
                                              <td>{{$transaction->user->name}}</td>

                                              <td>{{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat("MMM Do YYYY")}}</td>
                                          </tr>
                                          @empty
                                          <div>
                                              <img src="{{asset('assets/img/no-record.png')}}" alt="no record found">
                                          </div>
                                          @endforelse

                                      </tbody>
                                  </table>
                                  {{$transactions->links()}}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      @livewire("admin.ui.footer-component")
  </main>
