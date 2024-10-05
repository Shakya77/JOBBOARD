@if (Session::has('successMessage'))
    <div class="alert alert-success">{{ session::get('successMessage') }}</div>
@endif


@if (Session::has('errorMessage'))
    <div class="alert alert-danger">{{ session::get('errorMessage') }}</div>
@endif
