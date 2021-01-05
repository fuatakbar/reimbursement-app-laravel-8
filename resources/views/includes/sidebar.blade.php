<div class="card sidebar">
    <div class="card-header bg-primary">
        Main Menu
    </div>
    <div class="card-body mx-3">
        <ul>
            <li class="{{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                <a href="{{route('dashboard')}}"><i class="fas fa-angle-double-right"></i> Dashboard</a>
            </li>
            
            {{-- sidebar for business owner --}}
            @if (Auth::user()->role == 1)
                <li class="{{Request::segment(1) == 'managers' ? 'active' : ''}}">
                    <a href="{{route('managers')}}">
                        <i class="fas fa-angle-double-right"></i> Managers
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'finances' ? 'active' : ''}}">
                    <a href="{{route('finances')}}">
                        <i class="fas fa-angle-double-right"></i> Financial Admins
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'employers' ? 'active' : ''}}">
                    <a href="{{route('employers')}}">
                        <i class="fas fa-angle-double-right"></i> Employers
                    </a>
                </li>
            @endif

            {{-- sidebar for manager --}}
            @if (Auth::user()->role == 2)
                <li class="{{Request::segment(2) == 'approved-manager' ? 'active' : ''}}">
                    <a href="{{route('manager.approved')}}">
                        <i class="fas fa-angle-double-right"></i> Approved
                    </a>
                </li>
                <li class="{{Request::segment(2) == 'pending-manager' ? 'active' : ''}}">
                    <a href="{{route('manager.pending')}}">
                        <i class="fas fa-angle-double-right"></i> Pending
                    </a>
                </li>
                <li class="{{Request::segment(2) == 'rejected-manager' ? 'active' : ''}}">
                    <a href="{{route('manager.rejected')}}">
                        <i class="fas fa-angle-double-right"></i> Rejected
                    </a>
                </li>
            @endif

            {{-- sidebar for financial admin --}}
            @if (Auth::user()->role == 3)
                <li class="{{Request::segment(2) == 'processed-finance' ? 'active' : ''}}">
                    <a href="{{route('finance.processed')}}">
                        <i class="fas fa-angle-double-right"></i> Processed
                    </a>
                </li>
            @endif

            {{-- sidebar for employer --}}
            @if (Auth::user()->role == 4)
                <li class="{{Request::segment(2) == 'create' ? 'active' : ''}}">
                    <a href="{{route('employer.create')}}">
                        <i class="fas fa-angle-double-right"></i> Form Request
                    </a>
                </li>
                <li class="{{Request::segment(2) == 'pending-employer' ? 'active' : ''}}">
                    <a href="{{route('employer.pending')}}">
                        <i class="fas fa-angle-double-right"></i> Pending
                    </a>
                </li>
                <li class="{{Request::segment(2) == 'rejected-employer' ? 'active' : ''}}">
                    <a href="{{route('employer.rejected')}}">
                        <i class="fas fa-angle-double-right"></i> Rejected
                    </a>
                </li>
                <li class="{{Request::segment(2) == 'approved-employer' ? 'active' : ''}}">
                    <a href="{{route('employer.approved')}}">
                        <i class="fas fa-angle-double-right"></i> Approved
                    </a>
                </li>
                <li class="{{Request::segment(2) == 'processed-employer' ? 'active' : ''}}">
                    <a href="{{route('employer.processed')}}">
                        <i class="fas fa-angle-double-right"></i> Processed
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>