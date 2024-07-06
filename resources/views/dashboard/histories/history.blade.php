@section('page_title', 'Reviltan - Dashboard Histories')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('history') }}">Histories</a></li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Transactions History</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Reference Number</th>
                                        <th class="align-middle">Date</th>
                                        <th class="align-middle">Customers Name</th>
                                        <th class="align-middle">Vehicles Name</th>
                                        <th class="align-middle">Status</th>
                                        <th class="no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody id="orders">
                                    @foreach ($histories as $data)
                                    <tr class="btn-reveal-trigger">
                                        <td class="py-2">
                                            <strong>#{{ $data->reference_number ?: '-' }}</strong>
                                        <td class="py-2">{{ $data->created_at->format('d-m-Y') ?: '-'}}</td>
                                        <td class="py-2">{{ $data->customer_name ?: '-' }}</td>
                                        <td class="py-2">{{ $data->vehicle_name ?: '-' }}</td>
                                        <td class="py-2">
                                            @if ($data->transaction_status == 'Failed')
                                            <span class="badge badge-danger">Failed<span class="ms-1 fa fa-ban"></span></span>
                                            @elseif ($data->transaction_status == 'Finished')
                                            <span class="badge badge-success">Finished<span class="ms-1 fas fa-stream"></span></span>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="py-2 text-end">
                                            <div class="dropdown text-sans-serif">
                                                <button class="btn btn-primary tp-btn-light sharp" type="button" id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></span></button>

                                                <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item" href="{{ route('history.details', ['id' => $data->reference_number]) }}">Details</a>
                                                    </div>
                                                </div>
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
@endsection