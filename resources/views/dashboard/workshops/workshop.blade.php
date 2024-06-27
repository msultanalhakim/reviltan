@section('page_title', 'Reviltan - Dashboard Accounts')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('account') }}">Account</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Workshops</h4><br>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#basicModal"><i class="fas fa-pencil-alt"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Workshops</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('profile.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="workshop-dropdown">Workshop
                                                        Name</label>
                                                    <div class="basic-form">
                                                        <select
                                                            class="form-control @error('workshop') is-invalid @enderror"
                                                            id="workshop-dropdown" name="workshop_id">
                                                            <option value="" selected>Select Workshop</option>
                                                            @foreach($fetchWorkshops as $data)
                                                                <option value="{{ $data->workshop_id }}">
                                                                    {{ $data->workshop_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('workshop')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label" for="status-dropdown">Status</label>
                                                    <div class="basic-form">
                                                        <select
                                                            class="form-control @error('status') is-invalid @enderror"
                                                            id="status-dropdown" name="status">
                                                            <option value="" selected>Select Status</option>
                                                            {{-- <option value="{{ $workshops->status ?? '' }}"
                                                            selected>{{ $workshops->status ?? 'Select Status' }}
                                                            </option> --}}
                                                        </select>
                                                        @error('status')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label" for="vehicle-dropdown">Vehicle</label>
                                                    <div class="basic-form">
                                                        <select
                                                            class="form-control wide mb-3 @error('vehicle') is-invalid @enderror"
                                                            id="vehicle-dropdown" name="vehicle">
                                                            <option value="" selected>Select Vehicle</option>
                                                            {{-- <option value="{{ $workshops->vehicle_id ?? '' }}"
                                                            selected>{{ $workshops->status ?? 'Select Vehicle' }}
                                                            </option> --}}
                                                        </select>
                                                        @error('vehicle')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light btn-sm"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-sm">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-sm mb-4 table-striped display"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Workshop Name</th>
                                        <th>Status</th>
                                        <th>Vehicle Name</th>
                                        <th>Plate Number</th>
                                        <th>Customer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($workshops as $workshop)
                                    <tr>
                                        <td>{{ $workshop->workshop_name }}</td>
                                        <td>{{ $workshop->status }}</td>
                                        <td>{{ $workshop->vehicle_name }}</td>
                                        <td>{{ $workshop->plate_number }}</td>
                                        <td>{{ $workshop->customer_name ?: $workshop->email }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <!-- Form untuk mengubah status menjadi 'Underway' -->
                                                <form id="underwayForm{{ $workshop->workshop_id }}" method="POST" action="{{ route('workshop.updateStatus', ['id' => $workshop->workshop_id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="Underway">
                                                    <button type="button" class="btn btn-secondary shadow btn-xs sharp me-1 sweet-confirm" data-status="Underway"><i class="fas fa-wrench"></i></button>
                                                </form>
                                
                                                <!-- Form untuk mengubah status menjadi 'Postponed' -->
                                                <form id="postponedForm{{ $workshop->workshop_id }}" method="POST" action="{{ route('workshop.updateStatus', ['id' => $workshop->workshop_id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="Postponed">
                                                    <button type="button" class="btn btn-warning shadow btn-xs sharp me-1 sweet-confirm" data-status="Postponed"><i class="fas fa-history"></i></button>
                                                </form>
                                
                                                <!-- Form untuk mengubah status menjadi 'Finished' -->
                                                <form id="finishedForm{{ $workshop->workshop_id }}" method="POST" action="{{ route('workshop.updateStatus', ['id' => $workshop->workshop_id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="Finished">
                                                    <button type="button" class="btn btn-success shadow btn-xs sharp me-1 sweet-confirm" data-status="Finished"><i class="fas fa-check"></i></button>
                                                </form>
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
<script>
    $(document).ready(function () {
        let fetchVehicles = @json($fetchVehicles);

        $('#workshop-dropdown').on('change', function () {
            let idWorkshop = this.value;
            $("#status-dropdown").html('');
            $("#vehicle-dropdown").html('');
            $.ajax({
                url: "{{ url('api/fetch-vehicle') }}",
                type: "POST",
                data: {
                    workshop_id: idWorkshop,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    console.log(result); // Log the response
                    $.each(result.status, function (key, value) {
                        $("#status-dropdown").append('<option value="' + value
                            .status + '">' + value.status + '</option>');
                        $("#status-dropdown").append(
                            '<option value="Underway">Underway</option>');
                        $("#status-dropdown").append(
                            '<option value="Postponed">Postponed</option>');
                        $("#status-dropdown").append(
                            '<option value="Finished">Finished</option>');
                    });

                    $.each(result.vehicles, function (key, value) {
                        $("#vehicle-dropdown").append('<option value="' + value
                            .vehicle_id + '">' + value.plate_number + ' - ' +
                            value.vehicle_name + '</option>');
                    });
                }
            });
            $.each(fetchVehicles, function (key, value) {
                $("#vehicle-dropdown").append('<option value="' + value.vehicle_id + '">' +
                    value.plate_number + ' - ' + value.vehicle_name + '</option>');
            });
        });

    });

    function updateStatus(url, status) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    console.log('Status updated successfully');
                    window.location.reload(); // Refresh the page after status is updated
                },
                error: function(xhr, status, error) {
                    console.error('Error updating status:', error);
                }
            });
        }



</script>
<script>
    $(document).ready(function() {
        $('.sweet-confirm').on('click', function() {
            let status = $(this).data('status');
            let formId = $(this).closest('form').attr('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#${formId}`).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your action has been cancelled',
                        'error'
                    );
                }
            });
        });
    });
</script>

<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
@endsection
