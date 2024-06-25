<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                <i class="fas fa-home"></i>
                <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li id="service-sidebar-item">
                <a href="{{ route('service') }}#WizardService" aria-expanded="false">
                    <i class="fas fa-tools"></i>
                    <span class="nav-text">Service</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaction') }}" aria-expanded="false">
                <i class="fas fa-wallet"></i>
                <span class="nav-text">Transaction</span>
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                <i class="fas fa-table"></i>
                <span class="nav-text">Tables</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('account')}}">Accounts</a></li>
                    <li><a href="{{ route('customer') }}">Customers</a></li>
                    <li><a href="{{ route('vehicle') }}">Vehicles</a></li>
                    <li><a href="{{ route('booking') }}">Bookings</a></li>
                    <li><a href="{{ route('workshop') }}">Workshops</a></li>
                    <li><a href="{{ route('city') }}">Cities</a></li>
                    <li><a href="{{ route('province') }}">Provinces</a></li>
                </ul>
            </li>
        </ul>
        <div class="copyright">
            <p><strong>Reviltan</strong> © {{ date('Y'); }} All Rights Reserved</p>
        </div>
    </div>
</div>
