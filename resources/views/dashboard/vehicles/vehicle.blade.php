@section('page_title', 'Reviltan - Dashboard Vehicle')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('vehicle') }}">Vehicles</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Vehicles</h4><br>
                        <a href="{{ route('vehicle.add') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-sm mb-4 table-striped display"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Vehicle ID</th>
                                        <th>Vehicle Name</th>
                                        <th>Plate Numbers</th>
                                        <th>Owned by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vehicles as $key => $vehicle)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $vehicle->vehicle_name }}</td>
                                        <td>{{ $vehicle->plate_number }}</td>
                                        <td>{{ $vehicle->customer_name ?: $vehicle->email }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('vehicle.update', ['id' => $vehicle->vehicle_id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                @if (!in_array($vehicle->vehicle_id, $bookedVehicleIds))
                                                <a href="" class="btn btn-danger shadow btn-xs sharp sweet-destroy" data-id="{{ $vehicle->vehicle_id }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
    <script>
        $(document).ready(function() {
            $('.sweet-destroy').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior
                var vehicleId = $(this).data('id'); // Get the vehicle_id from data attribute
    
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
                        window.location.href = "{{ url('vehicle/destroy') }}/" + vehicleId; // Redirect to destroy route
                    }
                });
            });
        });
    </script>
@endsection