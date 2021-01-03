@extends('layouts.app')

@section('title')
    Class Management
@endsection

@section('content')
    <div class="container-fluid class-area my-5">
        <div class="row mx-3">
            <div class="col-12 col-lg-3 mb-4">
                {{-- sidebar menu --}}
                @include('includes.sidebar')
            </div>
            <div class="col-12 col-lg-9 mb-4">
                {{-- class table --}}
                <div class="card table-data">
                    <div class="card-header bg-primary">
                        <div class="row d-flex align-items-center">
                            <div class="col-6">
                                Classes Table
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" data-toggle="modal" data-target="#addClassModal">
                                    <button class="btn btn-primary">
                                        Create New Class
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content center">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Class Name</th>
                                                <th>Teacher Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse ($classes as $c)
                                                    <td>{{$c->name}}</td>
                                                    <td>{{$c->teacher->name}}</td>
                                                    <td>
                                                        {{-- edit button --}}
                                                        <a href="{{route('class.edit', [$c->id])}}" class="pr-1">
                                                            <button class="btn btn-secondary py-1 px-2"><i class="fas fa-cog"></i></button>
                                                        </a>
                                                        {{-- delete button --}}
                                                        <form class="d-inline" action="{{route('class.destroy', [$c->id])}}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger py-1 px-2" onclick="return confirm('Are you sure want to delete this class?')"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                @empty
                                                    <td colspan="3" class="text-center">
                                                        Empty Data
                                                    </td>
                                                @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{$classes->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add New Class Modal -->
    <div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('class.store')}}" method="post">
            @csrf
            @method('POST')
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Class Name</label>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="teacher_id">Choose Teacher</label>
                                <select class="form-control" name="teacher_id" id="teacher_id" required>
                                    @if ($teachers)
                                        @foreach ($teachers as $t)
                                            <option value="{{$t->id}}" class="text-capitalize">{{$t->name}}</option>
                                        @endforeach
                                    @else
                                        <option value="" class="text-capitalize">Empty Teacher</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">
                        Close</button>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection