@section('page_title', 'Reviltan - Dashboard')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="card tryal-gradient">
                                    <div class="card-body tryal row">
                                        <div class="col-xl-7 col-sm-6">
                                            <h2>Quick and efficient service guaranteed.</h2>
                                            <span>Ensure your vehicles are serviced at our automotive workshop.</span>
                                            <a href="{{ auth()->check() && auth()->user()->role === 'Administrator' ? route('transaction') : route('service') }}" class="btn btn-rounded fs-18 font-w500">Service Now</a>
                                        </div>
                                        <div class="col-xl-5 col-sm-6">
                                            <img src="{{ asset('assets/img/mechanic_service.png') }}" alt="" class="sd-shape">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6">
                                                <div class=" owl-carousel card-slider">
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Reviltan Garage Company Profile</h4>
                                                        <span class="fs-14 font-w400">Reviltan Garage is a modern automotive workshop that prioritizes the highest quality vehicle maintenance and repair
                                                        </span>
                                                    </div>
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Reviltan Garage Company Profile</h4>
                                                        <span class="fs-14 font-w400">Our skilled technicians is committed to providing reliable, efficient, and comprehensive automotive solutions
                                                        </span>
                                                    </div>
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Reviltan Garage Company Profile</h4>
                                                        <span class="fs-14 font-w400">Utilizing the latest advancements in automotive technology and adhering to stringent industry standards.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 redial col-sm-6">
                                                <div id="redial"></div>
                                                <span class="text-center d-block fs-18 font-w600">Rating <small
                                                        class="text-success">90%</small></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0 table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Workshop Name</th>
                                                        <th>Vehicle Name</th>
                                                        <th>Vehicle Color</th>
                                                        <th>Plate Number</th>
                                                        <th>Status</th>
                                                        <th>Last Updated</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="customers">
                                                    @foreach ($workshops as $key => $workshop)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ $workshop->workshop_name ?: '-'}}</td>
                                                            <td>{{ $workshop->vehicle_name ?: '-'}}</td>
                                                            <td>{{ $workshop->vehicle_color ?: '-'}}</td>
                                                            <td>{{ $workshop->censored_plate_number ?: '-'}}</td>
                                                            <td>
                                                                @if ($workshop->status == 'Underway' && $workshop->vehicle_name != '')
                                                                <span class="badge badge-rounded badge-warning">Underway</span>
                                                                @elseif ($workshop->status == 'Postponed' && $workshop->vehicle_name != '')
                                                                <span class="badge badge-rounded badge-dark">Postponed</span>
                                                                @elseif ($workshop->status == 'Finished' && $workshop->vehicle_name != '')
                                                                <span class="badge badge-rounded badge-primary">Finished</span>
                                                                @else
                                                                <span class="badge badge-rounded badge-secondary">Available</span>
                                                                @endif
                                                            
                                                            </td>
                                                            <td>
                                                                @if ($workshop->workshop_updated_at)
                                                                {{ \Carbon\Carbon::parse($workshop->workshop_updated_at)->format('H:i') }}
                                                            @else
                                                                -
                                                            @endif
                                                            
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- Apex Chart -->
    <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>

    <script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('assets/vendor/peity/jquery.peity.min.js') }}"></script>
    <!-- Dashboard 1 -->
    <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>

    <script src="{{ asset('assets/vendor/owl-carousel/owl.carousel.js') }}"></script>

    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>

    <script>
        function cardsCenter() {
            jQuery('.card-slider').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                //center:true,
                slideSpeed: 3000,
                paginationSpeed: 3000,
                dots: true,
                navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 1
                    },
                    800: {
                        items: 1
                    },
                    991: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1600: {
                        items: 1
                    }
                }
            })
        }

        jQuery(window).on('load', function () {
            setTimeout(function () {
                cardsCenter();
            }, 1000);
        });

    </script>
@endsection
