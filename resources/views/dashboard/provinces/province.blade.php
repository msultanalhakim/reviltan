@section('page_title', 'Reviltan - Dashboard Provinces')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('province') }}">Provinces</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Provinces</h4><br>
                        <a href="{{ route('province.add') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-sm mb-4 table-striped display"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Province Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($provinces as $key => $province)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $province->province_name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('province.update', ['id' => $province->province_id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a href="" class="btn btn-danger shadow btn-xs sharp sweet-destroy" data-id="{{ $province->province_id }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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
                var provinceId = $(this).data('id');
    
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
                        window.location.href = "{{ url('province/destroy') }}/" + provinceId; // Redirect to destroy route
                    }
                });
            });
        });
    </script>
@endsection