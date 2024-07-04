@section('page_title', 'Reviltan - Dashboard Vehicle')
@extends('dashboard.layouts.app')
@section('content')

<div class="content-body" style="min-height: 924px;">
    <div class="container-fluid">
        
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Vehicles</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Vehicles</h4><br>
                        <a href="{{ route('customer.vehicle.add') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        @if ($vehicles->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-sm mb-0 table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle Name</th>
                                        <th>Plate Number</th>
                                        <th>Chassis Number</th>
                                        <th>Engine Number</th>
                                        <th>Vehicle Color</th>
                                        <th>Mileage</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach ($vehicles as $key => $vehicle)    
                                <tr class="btn-reveal-trigger">
                                        <td class="py-2">{{ $key+1 }}</td>
                                        <td class="py-2">{{ $vehicle->vehicle_name}}</td>
                                        <td class="py-2">{{ $vehicle->plate_number }}</td>
                                        <td class="py-2">{{ $vehicle->chassis_number }}</td>
                                        <td class="py-2">{{ $vehicle->engine_number }}</td>
                                        <td class="py-2">{{ $vehicle->vehicle_color}}</td>
                                        <td class="py-2">{{ $vehicle->mileage }}</td>
                                        <td class="py-2">
                                            <div class="d-flex">
                                                <a href="{{ route('customer.vehicle.update', ['id' => $vehicle->vehicle_id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                @if (!in_array($vehicle->vehicle_id, $bookedVehicleIds))
                                                    <a href="" class="btn btn-danger shadow btn-xs sharp sweet-destroy"><i class="fa fa-trash"></i></a>
                                                    {{-- <a href="" id="logoutButton" class="dropdown-item ai-icon sweet-logout">
                                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                            <polyline points="16 17 21 12 16 7"></polyline>
                                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                                        </svg>
                                                        <span class="ms-2">Logout</span>
                                                    </a> --}}
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>    
                        @else
                        <div class="alert alert-warning solid mx-4 mt-4 mb-0"><strong>No vehicles found!</strong> Please add a vehicle.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- Datatable -->
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            $('.sweet-destroy').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('customer.vehicle.destroy', ['id' => $vehicles->vehicle_id]) }}"; // Redirect to logout route
                    }
                });
            });
        });
    </script> --}}
@endsection