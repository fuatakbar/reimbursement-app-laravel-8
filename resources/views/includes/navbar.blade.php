<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <a class="navbar-brand text-white" href="{{route('dashboard')}}">
        Reimbursement App
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <div class="navbar-nav">
            <ul class="navbar-nav mr-auto">
                <div class="row justify-content-end mt-4 mb-3 ml-1 d-lg-none d-block">
                    @auth
                    <form action="{{route('logout')}}" method="post">
                    @csrf
                    @method('POST')
            
                        <button type="submit" class="btn btn-primary">
                            Logout
                        </button>
                    </form>
                    @endauth
                </div>
            </ul>
        </div>
    </div>

    {{-- logout button desktop --}}
    <div class="col-12 col-lg-6 text-right d-none d-lg-block">
        <form action="{{route('logout')}}" method="post">
        @csrf
        @method('POST')
            @auth
                <span class="text-white pr-3">Welcome, {{Auth::user()->firstname}} as {{Auth::user()->role == 1 ? 'Business Owner' : (Auth::user()->role == 2 ? 'Manager' : (Auth::user()->role == 3 ? 'Financial Admin' : (Auth::user()->role == 4 ? 'Employer' : 'N/A')))}} </span>

                <button type="submit" class="btn btn-primary">
                    Logout
                </button>
            @endauth
        </form>
    </div>
</nav>