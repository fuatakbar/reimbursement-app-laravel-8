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
                            @if ($data->status == 'Approved')
                                <div class="col-12 col-md-6 text-right">
                                    <a href="#" data-toggle="modal" data-target="#proceedReimbursementModal">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-hand-point-right"></i> Proceed
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if ($data->status == 'Processed')
                                <div class="col-12 col-md-6 text-right">
                                    <b>Status</b>: 
                                    <button class="btn btn-status-processed">
                                        {{$data->status}}
                                    </button>
                                </div>
                            @endif
                        </div>
                        @if ($data->status == 'Approved')
                            <div class="row mb-3">
                                <div class="col-12">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li class="list-group-item bg-transparent border-0">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
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

    <!-- Proceed Reimbursement Modal -->
    @if ($data->status == 'Approved')
        <div class="modal fade" id="proceedReimbursementModal" tabindex="-1" role="dialog" aria-labelledby="proceedReimbursementModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('finance.update', [$data->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLongTitle">Proceed Reimbursement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                        </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="transfer_proof"><b>Transfer Proof</b></label><br>
                                    <input type="file" name="transfer_proof" id="transfer_proof" required>
                                </div>
                                Make sure the proof of transfer you choose is in the <b>format of jpg, jpeg or png</b> and <b>correctly matches</b> what is needed.
                            </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-grey" data-dismiss="modal">
                            Close</button>
                        <button type="submit" class="btn btn-secondary">Proceed</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    @endif
@endsection