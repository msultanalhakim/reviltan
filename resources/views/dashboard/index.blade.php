@section('page_title', 'Reviltan - Dashboard')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card tryal-gradient">
                                    <div class="card-body tryal row">
                                        <div class="col-xl-7 col-sm-6">
                                            <h2>Quick and efficient service guaranteed.</h2>
                                            <span>Ensure your vehicles are serviced at our automotive workshop.</span>
                                            <a href="javascript:void(0);" class="btn btn-rounded  fs-18 font-w500">Service Now</a>
                                        </div>
                                        <div class="col-xl-5 col-sm-6">
                                            <img src="{{ asset('assets/img/mechanic_service.png') }}" alt="" class="sd-shape">
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-xl-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body d-flex px-4 pb-0 justify-content-between">
                                        <div>
                                            <h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Vehicles</h4>
                                            <div class="d-flex align-items-center">
                                                <h2 class="fs-32 font-w700 mb-0">68</h2>
                                                <span class="d-block ms-4">
                                                    <svg width="21" height="11" viewbox="0 0 21 11" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.49217 11C0.590508 11 0.149368 9.9006 0.800944 9.27736L9.80878 0.66117C10.1954 0.29136 10.8046 0.291359 11.1912 0.661169L20.1991 9.27736C20.8506 9.9006 20.4095 11 19.5078 11H1.49217Z"
                                                            fill="#09BD3C"></path>
                                                    </svg>
                                                    <small
                                                        class="d-block fs-16 font-w400 text-success">+0,5%</small>
                                                </span>
                                            </div>
                                        </div>
                                        <div id="columnChart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body px-4 pb-0">
                                        <h4 class="fs-18 font-w600 mb-5 text-nowrap">Total Clients</h4>
                                        <div class="progress default-progress">
                                            <div class="progress-bar bg-gradient1 progress-animated"
                                                style="width: 40%; height:10px;" role="progressbar">
                                                <span class="sr-only">45% Complete</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end mt-2 pb-3 justify-content-between">
                                            <span>76 left from target</span>
                                            <h4 class="mb-0">42</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6">
                                                <div class=" owl-carousel card-slider">
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile Website
                                                            Project</h4>
                                                        <span class="fs-14 font-w400">Sed ut perspiciatis unde omnis
                                                            iste natus error sit voluptatem accusantium doloremque
                                                        </span>
                                                    </div>
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile Website
                                                            Project</h4>
                                                        <span class="fs-14 font-w400">Sed ut perspiciatis unde omnis
                                                            iste natus error sit voluptatem accusantium doloremque
                                                        </span>
                                                    </div>
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile Website
                                                            Project</h4>
                                                        <span class="fs-14 font-w400">Sed ut perspiciatis unde omnis
                                                            iste natus error sit voluptatem accusantium doloremque
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 redial col-sm-6">
                                                <div id="redial"></div>
                                                <span class="text-center d-block fs-18 font-w600">On Progress <small
                                                        class="text-success">70%</small></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header border-0 pb-0 mb-0">
                                                <div>
                                                    <h4 class="fs-20 font-w700">Workshop Information</h4>
                                                </div>
                                            </div>
                                            <div class="card-body pb-0 pt-1">
                                                @foreach ($workshops as $workshop)
                                                <div class="project-details">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <span class="big-wind">
                                                                <img src="{{ asset('assets/img/vehicle-icon.png') }}" alt="Vehicle Icon">
                                                            </span>
                                                            <div class="ms-3">
                                                                <h4 class="font-w600">
                                                                    @if ($workshop->vehicle_name != '')
                                                                    {{ $workshop->vehicle_name }} </span class="font-w400">- {{ $workshop->censored_plate_number }}</span>
                                                                    @else
                                                                    Workshop is available
                                                                    @endif
                                                                </h4>
                                                                <span class="fs-14 font-w400">
                                                                    @if ($workshop->vehicle_name != '')
                                                                    {{ $workshop->vehicle_color }}
                                                                    @else
                                                                    Workshop is available
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="projects">
                                                            <span class="btn btn-sm
                                                            @if ($workshop->status == 'Underway')
                                                                btn-warning
                                                            @elseif ($workshop->status == 'Postponed')
                                                                btn-dark
                                                            @elseif ($workshop->status == 'Finished')
                                                                btn-success
                                                            @else
                                                                btn-light
                                                            @endif font-w500 me-3">{{ $workshop->status ?: 'Available' }}</span>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-end mt-3 pb-3 justify-content-between">
                                                            @if ($workshop->updated_at)
                                                                <span class="fs-14 font-w400">Last Updated: {{ $workshop->updated_at->format('H:i') }}</span>
                                                            @else
                                                                <span class="fs-14 font-w400">Last Updated: Not available</span>
                                                            @endif

                                                            <span class="fs-14 font-w400">{{ $workshop->workshop_name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="card-footer pt-0 border-0">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-outline-primary d-block btn-rounded">Pin other
                                                    projects</a>
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

    {{-- <script src="{{ asset('assets/js/plugins-init/toastr-init.js') }}"></script> --}}

    <script>
        function cardsCenter() {

            /*  testimonial one function by = owl.carousel.js */



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
