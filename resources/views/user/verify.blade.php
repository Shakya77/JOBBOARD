@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="card ">
                <div class="card-header">Verify Account</div>
                <div class="card-body">
                    <p>Your account is not Verified. Please verify your Acc</p>
                    <a href="{{ route('resend.email') }}">Resent Verification email</a>
                </div>
            </div>
        </div>
    </div>
@endsection
