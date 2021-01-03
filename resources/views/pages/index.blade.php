@extends('layouts.app')

@section('title')
    Class Management
@endsection

@section('content')
    <div class="container-fluid user-dashboard my-5">
        <div class="row mx-3">
            <div class="col-12 col-lg-3 mb-4">
                {{-- sidebar menu --}}
                @include('includes.sidebar')
            </div>
            <div class="col-12 col-lg-6 mb-4">
                {{-- class table --}}
                <div class="card statistic">
                    <div class="card-header bg-primary">
                        Statistics
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-4 text-center">
                                <div class="card bg">
                                    <div class="card-header bg-secondary">
                                        Total Class
                                    </div>
                                    <div class="card-body total">
                                        {{$total_class}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 text-center">
                                <div class="card bg">
                                    <div class="card-header bg-secondary">
                                        Total Teacher
                                    </div>
                                    <div class="card-body total">
                                        {{$total_teacher}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 text-center">
                                <div class="card bg">
                                    <div class="card-header bg-secondary">
                                        Total Student
                                    </div>
                                    <div class="card-body total">
                                        {{$total_student}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 mb-4">
                {{-- profile action: edit name, change password --}}
                <div class="card profile-setting">
                    <div class="card-header bg-primary">
                        Profile Setting
                    </div>
                    <div class="card-body mx-3">
                        <ul>
                            <li>
                                <a href="http://" data-toggle="modal" data-target="#changeNameModal">
                                    <i class="fas fa-angle-double-right"></i> Name Setting
                                </a>
                            </li>
                            <li>
                                <a href="http://" data-toggle="modal" data-target="#changePasswordModal">
                                    <i class="fas fa-angle-double-right"></i> Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Change Name Modal -->
    <div class="modal fade" id="changeNameModal" tabindex="-1" role="dialog" aria-labelledby="changeNameModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('user.change.name')}}" method="post">
            @csrf
            @method('POST')
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">New Name</label>
                                <input class="form-control" type="text" name="name" id="name" required min="3">
                            </div>
                        </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">
                        Close</button>
                    <button type="submit" class="btn btn-secondary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Add Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('user.change.password')}}" method="post">
            @csrf
            @method('POST')
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="oldpassword">Old Password</label>
                                <input class="form-control" type="password" name="oldpassword" id="oldpassword" required min="6" max="30">
                            </div>
                            <div class="form-group mb-3">
                                <label for="newpassword">New Password</label>
                                <input class="form-control" type="password" name="newpassword" id="newpassword" required min="6" max="30">
                            </div>
                        </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">
                        Close</button>
                    <button type="submit" class="btn btn-secondary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection