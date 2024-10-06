@extends('layouts.admin.main')
@section('content')
    <div class="container mt-5">
        <div class="justify-content-center row">

            <div class="col-md-8 mt-5">
                <h1>Post a job ?</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="roles">Roles and Responsibilites</label>
                        <textarea name="roles" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-control" name="job_type" id="job_type" value="fulltime">
                        <label for="job_type">Fulltime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-control" name="job_type" id="job_type" value="parttime">
                        <label for="job_type">Parttime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-control" name="job_type" id="job_type" value="casual">
                        <label for="job_type">Casual</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-control" name="job_type" id="job_type" value="contract">
                        <label for="job_type">Contract</label>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
