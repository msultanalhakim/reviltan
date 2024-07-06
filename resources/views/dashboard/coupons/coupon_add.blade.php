@section('page_title', 'Reviltan - Coupon Add')
@extends('dashboard.layouts.app')

@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('coupon') }}">Coupons</a></li>
                <li class="breadcrumb-item"><a href="{{ route('coupon.add') }}">Add</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('coupon') }}"><i class="fas fa-arrow-left"></i></a> Add Coupon</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('coupon.store') }}">
                                @csrf
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Coupon Code</label>
                                        <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" value="{{ old('coupon_code') }}" placeholder="Coupon Code" required>
                                        @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Price</label>
                                        <div class="basic-form">
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" min="0" name="price" value="{{ old('price') }}" placeholder="Price" required>
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
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