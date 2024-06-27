@section('page_title', 'Reviltan - Dashboard')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('transaction') }}">Transaction</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Manage</a></li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 order-lg-2 mb-4">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Customer Cart</span>
                                    @if ($transactionData->payment_status == 'Pending' && $transactionData->total == '')
                                    <button type="button" class="badge badge-primary badge-pill" data-bs-toggle="modal"
                                    data-bs-target="#basicModal"><i class="fas fa-plus"></i></button>
                                    @endif
                                </h4>
                                <!-- Modal -->
                                <div class="modal fade" id="basicModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>

                                            <form method="POST" action="{{ route('transaction.item.store') }}" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                    @csrf
                                                    <input type="hidden" name="reference_number" value="{{ $transactionData->reference_number }}" required>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label" for="item-dropdown">Item Code</label>
                                                            <div class="basic-form">
                                                                <select
                                                                    class="form-control @error('item_id') is-invalid @enderror"
                                                                    id="item-dropdown" name="item_id">
                                                                    <option value="" selected>Select Item</option>
                                                                    @foreach($fetchCode as $data)
                                                                        <option value="{{ $data->item_id }}">
                                                                            {{ $data->item_code }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('item_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label" for="item_name">Item Name</label>
                                                            <div class="basic-form">
                                                                <input type="text" class="form-control @error('item_name') is-invalid @enderror" name="item_name" id="item_name" 
                                                                placeholder="Item Name" disabled>
                                                                @error('item_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label" for="price">Price</label>
                                                            <div class="basic-form">
                                                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" 
                                                                placeholder="Price" disabled>
                                                                @error('price')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label" for="quantity">Quantity</label>
                                                            <div class="basic-form">
                                                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" 
                                                                placeholder="Quantity" min="0" max="200" required>
                                                                @error('quantity')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger light btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group mb-3">
                                    @foreach ($detailsData as $data)
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        @php
                                            $itemPrice = $data->price * $data->quantity;
                                        @endphp
                                        <div>
                                            <h6 class="my-0">{{ $data->item_code }}</h6>
                                            <small class="text-muted">{{ $data->item_name }}</small>
                                        </div>
                                        <span>Rp {{ number_format($itemPrice, 0, ',', '.') }} IDR /
                                            <span class="text-muted">
                                                {{ $data->quantity }} {{ $data->quantity == 1 ? 'piece' : 'pieces' }}
                                            </span>
                                        </span>
                                    </li>
                                    @endforeach
                                    {{-- <li class="list-group-item d-flex justify-content-between active">
                                        <div class="text-white">
                                            <h6 class="my-0 text-white">Promo code</h6>
                                            <small>EXAMPLECODE</small>
                                        </div>
                                        <span class="text-white">-$5</span>
                                    </li> --}}
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (IDR)</span>
                                        @php
                                            $totalPrice = 0;
                                            foreach ($detailsData as $data) {
                                                $totalPrice += $data->price * $data->quantity;
                                            }
                                        @endphp
                                        <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }} IDR</strong>
                                    </li>
                                </ul>

                                    {{-- <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Promo code">
                                            <button type="submit" class="input-group-text">Redeem</button>
                                        </div>
                                    </form> --}}
                            </div>
                            <div class="col-lg-8 order-lg-1">
                                <form action="{{ route('transaction.manage.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h4 class="mb-3">Customer Billing</h4>
                                    <input type="hidden" name="total" value="{{ $totalPrice }}" required>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="reference_number" class="form-label">Reference Number</label>
                                            <input type="text" class="form-control @error('reference_number') is-invalid @enderror" name="reference_number" id="reference_number" placeholder="Reference Number" value="{{ $transactionData->reference_number }}" required readonly>
                                            @error('reference_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Customer Name</span></label>
                                        <input type="customer_name" class="form-control" name="customer_name" id="customer_name" value="{{ $transactionData->customer_name }}" placeholder="Customer Name" required readonly>
                                        @error('customer_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="vehicle_name" class="form-label">Vehicle Name</label>
                                        <input type="text" class="form-control" name="vehicle_name" id="vehicle_name" value="{{ $transactionData->vehicle_name }}" placeholder="Vehicle Name" required readonly>
                                        @error('vehicle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="plate_number" class="form-label">Plate Number</span></label>
                                        <input type="text" class="form-control" name="plate_number" id="plate_number" value="{{ $transactionData->plate_number }}" placeholder="Plate Number" required readonly>
                                        @error('plate_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="plate_number" class="form-label me-2">Payment Status</span></label><br>
                                        <div class="col-lg-3">
                                        @if ($transactionData->payment_status == 'Failed')
                                        <span class="badge badge-danger btn-block fs-14">Failed<span class="ms-1 fa fa-ban"></span></span>
                                        @elseif ($transactionData->payment_status == 'Pending')
                                        <span class="badge badge-warning btn-block fs-14">Pending<span class="ms-1 fas fa-stream"></span></span>
                                        @else
                                        <span class="badge badge-success btn-block fs-14">Paid<span class="ms-1 fa fa-check"></span></span>
                                        @endif
                                        </div>
                                    </div>


                                    @if($transactionData->payment_method == 'Bank Transfer')
                                    <div class="mb-3">
                                        <label for="plate_number" class="form-label">Transfer Receipt</span></label>
                                        <input type="text" class="form-control" name="plate_number" id="plate_number" value="{{ $transactionData->plate_number }}" placeholder="Plate Number" required disabled>
                                        @error('plate_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @endif
                                    {{-- <h4 class="mb-3">Payment</h4>

                                    <div class="d-block my-3">
                                        <div class="form-check custom-radio mb-2">
                                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                                            <label class="form-check-label" for="credit">Credit card</label>
                                        </div>
                                        <div class="form-check custom-radio mb-2">
                                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
                                            <label class="form-check-label" for="debit">Debit card</label>
                                        </div>
                                        <div class="form-check custom-radio mb-2">
                                            <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
                                            <label class="form-check-label" for="paypal">Paypal</label>
                                        </div>
                                    </div> --}}
                                    @if ($transactionData->payment_status == 'Pending' && $transactionData->payment_method == 'Bank Transfer')
                                        <hr class="mb-4 mt-4 me-2">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button class="btn btn-success btn-sm btn-block" type="submit" name="action" value="approve">Approve <i class="fas fa-check"></i></button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-danger btn-sm btn-block" type="submit" name="action" value="reject">Reject <i class="fas fa-times"></i></button>
                                            </div>
                                        </div> 
                                    @elseif ($transactionData->payment_status == 'Pending' && $transactionData->payment_method == 'Cash')
                                        <hr class="mb-4 mt-4 me-2">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button class="btn btn-success btn-sm btn-block" type="submit" name="action" value="approve">Approve <i class="fas fa-check"></i></button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-danger btn-sm btn-block" type="submit" name="action" value="approve">Reject <i class="fas fa-times"></i></button>
                                            </div>
                                        </div> 
                                    @elseif ($transactionData->payment_status == 'Pending' && $transactionData->total != '')
                                        <hr class="mb-4 mt-4 me-2">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="btn btn-warning btn-sm btn-block" type="submit" name="action" value="proceed" disabled>Wait for Customer Verification <i class="fas fa-hourglass-half"></i></button>
                                            </div>
                                        </div>
                                    @else 
                                        <hr class="mb-4 mt-4 me-2">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="btn btn-primary btn-sm btn-block" type="submit" name="action" value="proceed">Proceed Transaction <i class="fas fa-wrench"></i></button>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
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
        $(document).ready(function () {
            $('#item-dropdown').on('change', function () {
                let idItem = this.value;
                $("#item_name").html('');
                $("#price").html('');
    
                $.ajax({
                    url: "{{ url('api/fetch-item') }}",
                    type: "POST",
                    data: {
                        item_id: idItem,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result); // Log the response
                        if (result.length > 0) {
                            let item = result[0];
                            $("#item_name").val(item.item_name);
                            $("#price").val(item.price);
                        }
                    }
                });
            });
        });
    </script>
1    
@endsection