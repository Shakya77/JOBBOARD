@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <dov class="col-md-6">
                <h1>Looking for a an Employee?</h1>
                <h3>Please create an account</h3>
                <img src="{{ asset('image/register.png') }}" alt="this is the register image">
            </dov>

            <div class="col-md-6">
                <div class="card" id="card">
                    <div class="card-header">Employer Registeration</div>
                    <form action="" method="post" id="registrationForm">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Company name</label>
                                <input type="text" name="name" class="form-control" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mt-3">
                                <button class="btn btn-primary" id="btnRegister">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="message"></div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                console.log("kere")

            });
        </script>
    @endpush
    <script>
        var url = '{{ route('store.employer') }}';
        document.getElementById('btnRegister').addEventListener("click", function(event) {
            var form = document.getElementById("registrationForm");
            var card = document.getElementById("card");
            var messageDiv = document.getElementById('message');
            messageDiv.innerHTML = ''; // Fixed innerHtml to innerHTML
            var formData = new FormData(form);
            var button = event.target;
            button.disabled = true;
            button.innerHTML = 'Sending Email......'; // Fixed innerHtml to innerHTML

            fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            }).then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('error');
                }
            }).then(data => {
                button.innerHTML = 'Register'; // Fixed innerHtml to innerHTML
                button.disabled = false;
                messageDiv.innerHTML =
                    '<div class="alert alert-success">Registration was successful, Please Check your email</div>';
                card.style.display = 'none';
            }).catch(error => { // Moved catch to the right place
                button.innerHTML = 'Register'; // Fixed innerHtml to innerHTML
                button.disabled = false;
                messageDiv.innerHTML =
                    '<div class="alert alert-danger">Something went wrong, please try again</div>';
            });
        });
    </script>
@endsection
