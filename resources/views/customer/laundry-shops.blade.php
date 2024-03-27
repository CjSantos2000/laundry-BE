@extends('layouts.customer')
@section('title', 'Customer - Laundry Shops')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <div class="row">
                <div class="col-lg-12">
                <h2 class="title">Nearby Shops</h2>
                <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="table-light">
                    <th>Image</th>
                    {{-- <th>ID</th> --}}
                    <th>Name</th>
                    {{-- <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th> --}}
                    {{-- <th>Actions</th> --}}
                  </thead>
                  <tbody>
                    @foreach ($shop_admins as $shop_admin)
                      <tr>
                        <td>
                          <img src="{{ asset('storage/' . $shop_admin->image) }}" alt="Shop Image" width="100" height="100"/>
                        </td>
                        {{-- <td>{{ $shop_admin->id }}</td> --}}
                        <td>{{ $shop_admin->shop_name }}</td>
                        {{-- <td>{{ $shop_admin->phone_number }}</td>
                        <td>{{ $shop_admin->email }}</td>
                        <td>{{ $shop_admin->address }}</td> --}}
                        <td>
                          <p>
                            <a href="{{ route('customers.laundry-shops.transaction-modes', $shop_admin->id) }}" title="View" class="stretched-link"></a>
                          </p>
                        </td>
                      </tr>
                      {{-- <script>
                        initMap({{ json_encode($shop_admins) }});
                    </script> --}}
                    
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="box">
            <div class="row">
              <div class="col-lg-12">
                <h2 class="title">Transactions</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="table-light">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Actions</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Test</td>
                        <td>
                          <div class="d-flex">
                            <div class="action-button">
                              <a href="#" title="View">
                                <i class="fa-solid fa-eye"></i>
                              </a>
                            </div>
                            <div class="action-button"><a href="#" title="Edit"><i class="fa-solid fa-pencil"></i></a></div>
                            <div class="action-button">
                              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-modal-1" title="Delete">
                                <i class="fa-solid fa-trash color-red"></i>
                              </button>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script src="http://192.168.100.147:8000/js/map.js"></script>
@endsection