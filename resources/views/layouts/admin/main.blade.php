@include('layouts.admin.header')

<body class="sb-nav-fixed">
    @include('layouts.admin.navbar')
    <div id="layoutSidenav">
        @include('layouts.admin.sidebar')
        <div id="layoutSidenav_content" class="">
            {{-- @include('layouts.admin.body') --}}
            <div class="p-3">
                <div class="row ">
                    <div class="col-md-12">
                        <h3> Hello, {{ auth()->user()->name }}</h3>

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                        @if (Session::has('terminated'))
                            <div class="alert alert-warning">{{ Session::get('terminated') }}</div>
                        @endif
                        @if (!auth()->user()->billing_ends)
                            @if (Auth::check() && auth()->user()->user_type === 'employer')
                                <p>Your trial
                                    {{ now()->format('Y-m-d') > auth()->user()->user_trial ? 'has expired' : 'will expire' }}
                                    on {{ auth()->user()->user_trial }}</p>
                            @endif

                            @if (Auth::check() && auth()->user()->user_type === 'employer' && now()->format('Y-m-d') > auth()->user()->user_trial)
                                <p>Your membership
                                    {{ now()->format('Y-m-d') > auth()->user()->billing_ends ? 'has expired' : 'will expire' }}
                                    on {{ auth()->user()->billing_ends }}</p>
                            @endif
                        @endif

                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-3">
                        <div class="card-counter primary">
                            <p class="text-center mt-3 lead">
                                User profile
                            </p>
                            <button class="btn btn-primary float-end">View</button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <p class="text-center mt-3 lead">
                                Post job
                            </p>
                            <button class="btn btn-primary float-end">View</button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter success">
                            <p class="text-center mt-3 lead">
                                All jobs
                            </p>
                            <button class="btn btn-primary float-end">View</button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter info">
                            <p class="text-center mt-3 lead">
                                Item
                            </p>
                            <button class="btn btn-primary float-end">View</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin.footer')
        </div>
    </div>

</body>

</html>
