<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">

    <title>@yield('page_title')</title>

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
	<link href="{{ asset('assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <!-- Style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
    @yield('style')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css" rel="stylesheet"></head>

<body>
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <div id="main-wrapper">
        @include('dashboard.partials.nav-header')

        {{-- @include('dashboard.partials.chatbox') --}}

        @include('dashboard.partials.header')

        @include('dashboard.partials.sidebar')

        @yield('content')

        @include('dashboard.partials.footer')
    </div>
    <!-- Required vendors -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
         @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break; 
            }
            @endif 
            </script>
    </script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/sweetalert.init.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js
    "></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const submitButton = document.getElementById("submit-button");
    
            form.addEventListener("submit", function(event) {
                // Disable the submit button to prevent multiple clicks
                submitButton.disabled = true;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan URL saat ini
            var currentUrl = window.location.href;
    
            // Mendapatkan elemen sidebar yang ingin diaktifkan
            var serviceSidebarItem = document.getElementById('service-sidebar-item-service');
    
            // Daftar fragmen yang ingin diperiksa untuk mengaktifkan sidebar
            var fragments = ['#wizard_Service', '#wizard_Time', '#wizard_Details'];
    
            // Periksa apakah URL saat ini mengandung salah satu fragmen yang diinginkan
            var isActive = fragments.some(function(fragment) {
                return currentUrl.indexOf(fragment) !== -1;
            });
    
            // Jika salah satu fragmen ditemukan, tambahkan kelas 'active' ke elemen sidebar
            if (isActive) {
                serviceSidebarItem.classList.add('mm-active');
            }
        });
    </script>
    
    <!-- Script to handle SweetAlert2 confirmation -->
    <script>
        $(document).ready(function() {
            $('.sweet-logout').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('profile.logout') }}"; // Redirect to logout route
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentUrl = window.location.href;
            var serviceSidebarItem = document.getElementById('service-sidebar-item');

            if (currentUrl.includes('{{ route('service') }}#WizardService') || 
                currentUrl.includes('{{ route('service') }}#WizardTime') || 
                currentUrl.includes('{{ route('service') }}#WizardDetails') || 
                currentUrl === "{{ route('service') }}") {
                serviceSidebarItem.classList.add('active');
            } else {
            }
        });
    </script>
    
    @yield('script')
    
    

</body>

</html>
