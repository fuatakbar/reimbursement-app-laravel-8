<div class="card sidebar">
    <div class="card-header bg-primary">
        Main Menu
    </div>
    <div class="card-body mx-3">
        <ul>
            <li class="{{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                <a href="{{route('dashboard')}}"><i class="fas fa-angle-double-right"></i> Dashboard</a>
            </li>
            <li class="{{Request::segment(1) == 'class' ? 'active' : ''}}">
                <a href="{{route('class.index')}}">
                    <i class="fas fa-angle-double-right"></i> Classes
                </a>
            </li>
            <li class="{{Request::segment(1) == 'teacher' ? 'active' : ''}}">
                <a href="{{route('teacher.index')}}">
                    <i class="fas fa-angle-double-right"></i> Teachers
                </a>
            </li>
            <li class="{{Request::segment(1) == 'student' ? 'active' : ''}}">
                <a href="{{route('student.index')}}">
                    <i class="fas fa-angle-double-right"></i> Students
                </a>
            </li>
        </ul>
    </div>
</div>