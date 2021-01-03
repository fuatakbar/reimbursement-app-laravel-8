@extends('layouts.app')

@section('title')
    @if (Request::segment(1) == 'managers')
        Reimbursement App - Manager List
    @elseif (Request::segment(1) == 'finances')
        Reimbursement App - Finance Admin List
    @elseif (Request::segment(1) == 'employers')
        Reimbursement App - Employer List
    @endif
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
                        Managers Table
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Division</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $d)
                                        <tr>
                                            <td>{{$data->firstItem() + $key}}</td>
                                            <td>{{$d->firstname . ' ' . $d->lastname}}</td>
                                            <td>{{$d->divisions->name}}</td>
                                            <td>
                                                {{-- edit button --}}
                                                <a href="#" class="pr-1">
                                                    <button class="btn btn-secondary py-1 px-2"><i class="fas fa-cog"></i></button>
                                                </a>
                                                {{-- delete button --}}
                                                <form class="d-inline" action="#" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger py-1 px-2" onclick="return confirm('Are you sure want to delete this student?')"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                Data Empty
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection