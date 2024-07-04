@section('page_title', 'Reviltan - Dashboard')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Layout</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Blank</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card mt-3">
                    <div class="card-header"> Invoice <strong>02/07/2024</strong> <span class="float-end">
                            <strong>Status:</strong> Completed</span> </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <h6>Customer:</h6>
                                <div> <strong>Wulandari</strong> </div>
                                <div>082113155212</div>
                                <div>Perumahan Bumi Mutiara Blok DD 01, RT 001, RW 032</div>
                                <div>Email: wulandari@gmail.com</div>
                            </div>
                            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <h6>Vehicle:</h6>
                                <div> <strong>Mercedes Benz AMG GT63</strong> </div>
                                <div>R 1 CH</div>
                                <div>2HXSKLW20KDMLSAKPWL</div>
                                <div>4NCS0PVX4LBR790</div>
                                <div>49281</div>
                            </div>
                            {{-- <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                                <div class="row align-items-center">
                                    <div class="col-sm-9"> 
                                        <span>Please send exact amount: <strong class="d-block">0.15050000 BTC</strong>
                                            <strong>1DonateWffyhwAjskoEwXt83pHZxhLTr8H</strong></span><br>
                                        <small class="text-muted">Current exchange rate 1BTC = $6590 USD</small>
                                    </div>
                                    <div class="col-sm-3 mt-3"> <img src="images/qr.png" alt="" class="img-fluid width110"> </div>
                                </div>
                            </div> --}}
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
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">SRV</td>
                                        <td class="left">Service</td>
                                        <td class="right">600.000 IDR</td>
                                        <td class="center">3</td>
                                        <td class="right">1.800.000 IDR</td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left">SRV-OIL</td>
                                        <td class="left">Oil Change</td>
                                        <td class="right">80.000 IDR</td>
                                        <td class="center">1</td>
                                        <td class="right">80.000 IDR</td>
                                    </tr>
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
                                            <td class="right">1.880.000 IDR</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Discount</strong></td>
                                            <td class="right">90.000 IDR</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>1.790.000 IDR</strong><br>
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
