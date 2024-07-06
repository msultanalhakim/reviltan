@section('page_title', 'Reviltan - Transaction Add')
@extends('dashboard.layouts.app')

@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('transaction') }}">Transactions</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transaction.add') }}">Add</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('transaction') }}"><i class="fas fa-arrow-left"></i></a> Add Transaction</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('transaction.store') }}">
                                @csrf
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="total">Total</label>
                                        <div class="basic-form">
                                            <input type="number" class="form-control @error('total') is-invalid @enderror" min="0" name="total" value="{{ old('total') }}" placeholder="Total" required>
                                            @error('total')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-block my-3">
                                        <label for="payment_method">Payment Method</label>
                                        <div class="form-check custom-radio mb-2">
                                            <input id="cash" name="payment_method" type="radio" value="Cash" class="form-check-input" required>
                                            <label class="form-check-label" for="cash">Cash</label>
                                        </div>
                                        <div class="form-check custom-radio mb-2">
                                            <input id="transfer" name="payment_method" type="radio" value="Bank Transfer" class="form-check-input" required>
                                            <label class="form-check-label" for="transfer">Bank Transfer</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="coupon_code">Coupon Code</label>
                                        <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" value="{{ old('coupon_code') }}" placeholder="Coupon Code" required>
                                        @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="coupon_code">Select Vehicle</label>
                                        <div class="basic-form">
                                            <select class="@error('customer_id') is-invalid @enderror" name="customer_id" id="single-select" style="border:0.5rem solid #fff">
                                                <option value="">Select Vehicle</option>
                                            </select>
                                        </div>
                                        @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="coupon_code">Select Customer</label>
                                        <div class="basic-form">
                                            <select class="@error('customer_id') is-invalid @enderror" name="customer_id" id="single-select" style="border:0.5rem solid #fff">
                                                <option value="">Select Customer</option>
                                            </select>
                                        </div>
                                        @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" class="submit-button">Insert</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins-init/select2-init.js') }}"></script>
@endsection