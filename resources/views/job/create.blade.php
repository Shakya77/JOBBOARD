@extends('layouts.admin.main')
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-11">
            <h1>Post a job ?</h1>
            <div class="form-group">
                <form action="" method="post">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="feature_image">feature Image</label>
                        <input type="file" name="feature_image" id="feature_image" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="roles">Roles and Responsibilites</label>
                        <textarea name="roles" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group row m-5 container text">
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="job_type" id="fulltime"
                                    value="fulltime">
                                <label for="fulltime">Fulltime</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="job_type" id="parttime"
                                    value="parttime">
                                <label for="parttime">Part Time</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="job_type" id="casual"
                                    value="casual">
                                <label for="casual">Casual</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="job_type" id="contract"
                                    value="contract">
                                <label for="contract">Contract</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="date">Application closing date</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Post a Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
