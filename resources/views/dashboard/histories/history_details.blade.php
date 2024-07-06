@section('page_title', 'Reviltan - History Details')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('history') }}">Histories</a></li>
                <li class="breadcrumb-item"><a href="" onclick="location.reload(); return false;">Details</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card mt-3">
                    <div class="card-header"> Invoice <strong>{{ $history->created_at->format('d/m/Y') ?: '-' }}</strong> <span class="float-end">
                            <strong>Status:</strong> {{ $history->transaction_status }}</span> </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <h6>Customer:</h6>
                                <div> <strong>{{ $history->customer_name }}</strong></div>
                                <div>{{ $history->email }}</div>
                                <div>{{ $history->address }}</div>
                                <div>{{ $history->phone }}</div>
                            </div>
                            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <h6>Vehicle:</h6>
                                <div> <strong>{{ $history->vehicle_name }}</strong> - {{ $history->plate_number }} </div>
                                <div>{{ $history->vehicle_color }}</div>
                                <div>{{ $history->chassis_number }}</div>
                                <div>{{ $history->engine_number }}</div>
                                <div>{{ $history->mileage }}</div>
                            </div>
                            <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                                <div class="row align-items-center">
                                    <div class="col-sm-9 col-lg-12">
                                        <span>{{ $history->payment_method }}<br>
                                            Status: <strong>{{ $history->transaction_status }}</strong>
                                        </span>
                                        <br>
                                        @if ($history->payment_status == 'Paid')
                                        <span class="badge badge-success">Paid<span class="ms-1 fas fa-stream"></span></span>
                                        @elseif ($history->payment_status == 'Failed')
                                        <span class="badge badge-danger">Failed<span class="ms-1 fas fa-stream"></span></span>
                                        @else
                                        <span class="badge badge-warning">Pending<span class="ms-1 fas fa-stream"></span></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">ID</th>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th class="right">Price</th>
                                        <th class="center">Quantity</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp

                                    @foreach ($items as $key => $item)
                                    @php
                                        $total += $item->price * $item->quantity;
                                    @endphp
                                    <tr>
                                        <td class="center">{{ $key+1 }}</td>
                                        <td class="left strong">{{ $item->item_code }}</td>
                                        <td class="left">{{ $item->item_name }}</td>
                                        <td class="right">{{ number_format($item->price, 0, ',', '.') }} IDR</td>
                                        <td class="center">{{ $item->quantity }}</td>
                                        <td class="right">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} IDR</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5"> </div>
                            <div class="col-lg-4 col-sm-5 ms-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Subtotal</strong></td>
                                            <td class="right">{{ number_format($total, 0, ',', '.') }} IDR</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Discount</strong></td>
                                            <td class="right">{{ number_format($history->discount, 0, ',', '.') }} IDR</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>{{ number_format($total-$history->discount, 0, ',', '.') }} IDR</strong><br>
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
