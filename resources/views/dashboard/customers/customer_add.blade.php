@section('page_title', 'Reviltan - Dashboard')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Shop</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Customer</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form>

                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" placeholder="1234 Main St">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Phone Number</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Province</label>
                                        <div class="basic-form">
                                            <select class="default-select form-control wide mb-3" name="province">
                                                <option value="">Province</option>
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                                <option>Option 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>City</label>
                                        <div class="basic-form">
                                            <select class="default-select form-control wide mb-3" name="city">
                                                <option value="">City</option>
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-md-12">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" rows="4" id="address" name="address" style="min-height: 180px;max-height:220px" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
