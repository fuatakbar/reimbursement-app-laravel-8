@extends('layouts.app')

@section('title')
    Reimbursement App - Request Form
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
                        Form Reimbursement Request - Date: {{Carbon\Carbon::now()->format('d M Y')}}
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li class="list-group-item bg-transparent border-0">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('employer.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-row mb-4">
                                <div class="col-md-6">
                                    <label for="expense_proof">Expense Proof</label>
                                    <input type="file" name="expense_proof" required>
                                </div>
                                <div class="col-md-6">
                                    Note: <br>
                                    Proof of transaction must be <b>clear</b> and <b>contain the total</b> expenditure issued
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col-md-6">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" required placeholder="please provide a clear description of the expenses incurred here..">{{old('description')}}</textarea>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="amount_spent">Amount Spent</label>
                                    <input class="form-control" type="number" name="amount_spent" id="amount_spent" min="5000" max="100000000" placeholder="minimum: 5000" value="{{old('amount_spent')}}">
                                </div>
                            </div>
                            <div class="form-row justify-content-center mb-4">
                                <div class="col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        Submit
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