@section('page_title', 'Reviltan - Account Update')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('account') }}">Accounts</a>
                </li>
                <li class="breadcrumb-item"><a href="" onclick="location.reload(); return false;">Update</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('account') }}"><i
                                    class="fas fa-arrow-left"></i></a> Update Account</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('account.update.store') }}">
                                @csrf
                                <div class="row mb-2">
                                    <input type="hidden" name="id" value="{{ $account->id }}" required>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            name="username" value="{{ $account->username }}" placeholder="Username"
                                            required>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Role</label>
                                        <select name="role" id="role"
                                            class="form-control @error('role') is-invalid @enderror">
                                            <option value="{{ $account->role }}">{{ $account->role }}</option>
                                            <option value="User">User</option>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Status</label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="{{ $account->status }}">{{ $account->status }}</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        id="submit-button">Update</button>
                                </div>
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
<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins-init/select2-init.js') }}"></script>
@endsection
