@section('page_title', 'Reviltan - City Update')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('coupon') }}">Coupons</a></li>
                <li class="breadcrumb-item"><a href="" onclick="location.reload(); return false;">Update</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('coupon') }}"><i class="fas fa-arrow-left"></i></a> Update Coupon</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('coupon.update.store') }}">
                                @csrf
                                <input type="hidden" name="coupon_id" value="{{ $coupon->coupon_id }}" required>
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Coupon Code</label>
                                        <input type="text" class="form-control  @error('coupon_code') is-invalid @enderror" value="{{ $coupon->coupon_code }}" name="coupon_code" placeholder="Coupon Code">
                                        @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Province Name</label>
                                        <div class="basic-form">
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ $coupon->price }}" min="0" name="price" placeholder="Price" required>
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" class="submit-button">Update</button>
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