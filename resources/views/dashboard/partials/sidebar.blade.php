<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="{{ request()->is('/') || request()->is('dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <!-- Customer Menu -->
            @if(Auth::user()->role == 'User')
                <li id="service-sidebar-item">
                    <a href="{{ route('customer.vehicles') }}" aria-expanded="false">
                        <i class="fas fa-car"></i>
                        <span class="nav-text">Vehicles</span>
                    </a>
                </li>
                <li id="service-sidebar-item-service">
                    <a href="{{ route('service') }}" aria-expanded="false">
                        <i class="fas fa-tools"></i>
                        <span class="nav-text">Service</span>
                    </a>
                </li>
                <li id="service-sidebar-item-service">
                    <a href="{{ route('history') }}" aria-expanded="false">
                        <i class="fas fa-history"></i>
                        <span class="nav-text">Transactions</span>
                    </a>
                </li>
            @endif
            <!-- Admin Menu -->
            @if(Auth::user()->role == 'Administrator')
                <li>
                    <a href="{{ route('transaction') }}" aria-expanded="false">
                        <i class="fas fa-wallet"></i>
                        <span class="nav-text">Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('workshop') }}" aria-expanded="false">
                        <i class="fas fa-wrench"></i>
                        <span class="nav-text">Workshop</span>
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
                        <li><a href="{{ route('city') }}">Cities</a></li>
                        <li><a href="{{ route('province') }}">Provinces</a></li>
                        <li><a href="{{ route('coupon') }}">Coupons</a></li>
                        <li><a href="{{ route('item') }}">Items</a></li>
                    </ul>
                </li>
            @endif
        </ul>
        <div class="copyright">
            <p><strong>Reviltan</strong> © {{ date('Y') }} All Rights Reserved</p>
        </div>
    </div>
</div>
