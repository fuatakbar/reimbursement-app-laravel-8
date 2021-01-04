@extends('layouts.app')

@section('title')
    Reimbursement App - Detail Request
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
                        <div class="row justify-content-between">
                            <div class="col-md-8">
                                Reimbursement Request Detail - Date : {{$data->filed_date}}
                            </div>
                            <div class="col-md-4 text-right">
                                Total : Rp {{$data->total}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div class="col-12 col-md-6">
                                <b>Employer Detail</b>: <br>
                                Full Name : {{$data->employer->firstname . ' ' . $data->employer->lastname}} <br>
                                Email : {{$data->employer->email}} <br>
                                Total Request : {{$requests->total()}}
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                <form action="{{route('manager.update', [$data->id])}}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        @if ($data->status == 'Pending')
                                            <div class="col-md-6 col-12 mb-3">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="Pending" selected>Pending (Current)</option>
                                                    <option value="Rejected">Rejected</option>
                                                    <option value="Approved">Approved</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <button type="submit" class="btn btn-block btn-primary" onclick="return confirm('Are you sure to make change on this reimbursement status?')">
                                                    Update Status
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                                @if ($data->status == 'Rejected')
                                    <b>Status</b>: 
                                    <button class="btn btn-status-reject">
                                        {{$data->status}}
                                    </button>
                                @elseif ($data->status == 'Approved') 
                                    <b>Status</b>: 
                                    <button class="btn btn-status-approved">
                                        {{$data->status}}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Expense Proof</th>
                                        <th>Description</th>
                                        <th>Amount Spent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($requests as $key => $r)
                                        <tr class="text-center">
                                            <td>{{$requests->firstItem() + $key}}</td>
                                            <td>
                                                <a href="{{Storage::url($r->expense_proof)}}" target="__blank">
                                                    <img src="{{Storage::url($r->expense_proof)}}" class="img-fluid img-thumbnail" width="150"">
                                                </a>
                                            </td>
                                            <td>{{substr($r->description, 0, 20)}}</td>
                                            <td>{{$r->amount_spent}}</td>
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
                        {{$requests->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection