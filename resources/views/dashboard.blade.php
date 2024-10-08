@extends('layouts.admin.main')

@section('content')
    <div class="container-fluid">
        <div class="row ">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            @if (Session::has('terminated'))
                <div class="alert alert-warning">{{ Session::get('terminated') }}</div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="container-fluid px-4">
                <h1 class="mt-4">Hello, {{ auth()->user()->name }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        @if (!auth()->user()->billing_ends)
                            @if (Auth::check() && auth()->user()->user_type == 'employer')
                                <p>Your trial
                                    {{ now()->format('Y-m-d') > auth()->user()->user_trial ? 'has expired' : 'will expire' }}
                                    on {{ auth()->user()->user_trial }}</p>
                            @endif

                            @if (Auth::check() && auth()->user()->user_type == 'employer' && now()->format('Y-m-d') > auth()->user()->user_trial)
                                <p>Your membership
                                    {{ now()->format('Y-m-d') > auth()->user()->billing_ends ? 'has expired' : 'will expire' }}
                                    on {{ auth()->user()->billing_ends }}</p>
                            @endif
                        @endif
                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Primary Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Warning Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Success Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Danger Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
