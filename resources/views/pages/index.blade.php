@extends('layouts.app')

@section('title')
    Reimbursement App - Dashboard
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
                        @if (Auth::user() && Auth::user()->role == 1)
                            Reimbursement's Statistics
                        @elseif (Auth::user() && Auth::user()->role == 2)
                            Reimbursement Requests
                        @elseif (Auth::user() && Auth::user()->role == 3)
                            Reimbursement Unprocessed
                        @elseif (Auth::user() && Auth::user()->role == 4)
                            Your Reimbursements List by Date
                        @endif
                    </div>
                    <div class="card-body">
                        @if (Auth::user() && Auth::user()->role == 1)
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-4 text-center mb-3">
                                    <div class="card bg">
                                        <div class="card-header bg-secondary">
                                            Total
                                        </div>
                                        <div class="card-body total">
                                            10
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 text-center mb-3">
                                    <div class="card bg">
                                        <div class="card-header bg-secondary">
                                            Approved
                                        </div>
                                        <div class="card-body total">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 text-center mb-3">
                                    <div class="card bg">
                                        <div class="card-header bg-secondary">
                                            Pending
                                        </div>
                                        <div class="card-body total">
                                            3
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 text-center mb-3">
                                    <div class="card bg">
                                        <div class="card-header bg-secondary">
                                            Rejected
                                        </div>
                                        <div class="card-body total">
                                            2
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 text-center mb-3">
                                    <div class="card bg">
                                        <div class="card-header bg-secondary">
                                            Cancelled
                                        </div>
                                        <div class="card-body total">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 text-center mb-3">
                                    <div class="card bg">
                                        <div class="card-header bg-secondary">
                                            Processed
                                        </div>
                                        <div class="card-body total">
                                            5
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user() && Auth::user()->role == 4)
                            <div class="table-responsive mb-3">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Filed Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $d)
                                            <tr class="text-center">
                                                <td>{{$d->filed_date}}</td>
                                                <td> 
                                                    @if ($d->status == 'Pending')
                                                        <button class="btn btn-status-pending text-capitalize">
                                                            {{$d->status}}
                                                        </button>
                                                    @elseif ($d->status == 'Approved')
                                                        <button class="btn btn-status-approved text-capitalize">
                                                            {{$d->status}}
                                                        </button>
                                                    @elseif ($d->status == 'Rejected')
                                                        <button class="btn btn-status-reject text-capitalize">
                                                            {{$d->status}}
                                                        </button>
                                                    @elseif ($d->status == 'Processed')
                                                        <button class="btn btn-status-processed text-capitalize">
                                                            {{$d->status}}
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>Rp {{$d->total}}</td>
                                                <td>
                                                    {{-- detail button --}}
                                                    <a href="{{route('employer.show', [$d->id])}}" class="pr-1">
                                                        <button class="btn btn-secondary py-1 px-2"><i class="far fa-eye"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Empty Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{$data->links()}}
                        @endif
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
                            @if (Auth::user()->role == 4)
                                <li>
                                    <a href="http://" data-toggle="modal" data-target="#changeBankModal">
                                        <i class="fas fa-angle-double-right"></i> Bank Account
                                    </a>
                                </li>
                            @endif
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Change Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="firstname">First firstname</label>
                                <input class="form-control" type="text" name="firstname" id="firstname" required min="3" value="{{Auth::user()->firstname}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="lastname">Last lastname</label>
                                <input class="form-control" type="text" name="lastname" id="lastname" required min="3" value="{{Auth::user()->lastname}}">
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

    <!-- Add Change Bank Modal -->
    @if (Auth::user()->role == 4 && Auth::user()->bank_account != null)
        <div class="modal fade" id="changeBankModal" tabindex="-1" role="dialog" aria-labelledby="changeBankModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('user.change.bank')}}" method="post">
                @csrf
                @method('POST')
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Bank Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                        </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="account_number">Account Number</label>
                                    <input class="form-control" type="text" name="account_number" id="account_number" required min="7" max='30' value="{{$bank_account->account_number}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="bank_code">Bank Code</label>
                                    <input class="form-control" type="text" name="bank_code" id="bank_code" required min="2" max='5' value="{{$bank_account->bank_code}}">
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
    @endif

    <!-- Add Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('user.change.password')}}" method="post">
            @csrf
            @method('POST')
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
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