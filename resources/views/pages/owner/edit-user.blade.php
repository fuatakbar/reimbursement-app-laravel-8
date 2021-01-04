@extends('layouts.app')

@section('title')
    Reimbursement App - Edit User
@endsection

@section('content')
    <div class="container-fluid user-dashboard my-5">
        <div class="row mx-3">
            <div class="col-12 col-lg-3 mb-4">
                {{-- sidebar menu --}}
                @include('includes.sidebar')
            </div>
            <div class="col-12 col-lg-9 mb-4">
                {{-- class table --}}
                <div class="card statistic">
                    <div class="card-header bg-primary">
                        Edit User Data
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.update', [$user->id])}}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-row mb-4">
                                <div class="col-md-6">
                                    <label for="firstname">First Name</label>
                                    <input class="form-control" type="text" name="firstname" id="firstname" required value="{{$user->firstname}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname">First Name</label>
                                    <input class="form-control" type="text" name="lastname" id="lastname" required value="{{$user->lastname}}">
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col-md-6">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role" id="role">
                                        @foreach ($roles as $r)
                                            <option class="text-capitalize" value="{{$r->id}}" {{$user->role == (string)$r->id ? 'selected' : ''}}>
                                                {{$r->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="division">Division</label>
                                    <select class="form-control" name="division" id="division">
                                        @foreach ($divisions as $d)
                                            <option class="text-capitalize" value="{{$d->id}}" {{$user->division == (string)$d->id ? 'selected' : ''}}>
                                                {{$d->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row justify-content-center mb-4">
                                <div class="col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection