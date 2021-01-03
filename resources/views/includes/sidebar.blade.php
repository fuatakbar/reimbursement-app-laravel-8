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
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Managers
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'teacher' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Financial Admins
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'student' ? 'active' : ''}}">
                    <a href="#}">
                        <i class="fas fa-angle-double-right"></i> Employers
                    </a>
                </li>
            @endif

            {{-- sidebar for manager --}}
            @if (Auth::user()->role == 2)
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Approved
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Pending
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Rejected
                    </a>
                </li>
            @endif

            {{-- sidebar for financial admin --}}
            @if (Auth::user()->role == 3)
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Processed
                    </a>
                </li>
            @endif

            {{-- sidebar for employer --}}
            @if (Auth::user()->role == 4)
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Rejected
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Pending
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Approved
                    </a>
                </li>
                <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                    <a href="#">
                        <i class="fas fa-angle-double-right"></i> Processed
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>