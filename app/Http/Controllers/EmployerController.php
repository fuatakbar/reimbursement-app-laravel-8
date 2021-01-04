<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
use Storage;
use Hash;
use Carbon\Carbon;
use Log;

// models
use App\Models\User;
use App\Models\BankAccount;
use App\Models\Reimbursement;
use App\Models\ReimbursementRequest;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.employer.form-request');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_proof' => 'mimes:jpg,jpeg,png|max:2048|required',
            'description' => 'required',
            'amount_spent' => 'required|min:4|max:9'
        ], [
            'expense_proof.mimes' => 'Please choose valid image file type (must jpg, jpeg).',
            'expense_proof.max' => 'Image file must be lower than 2MB',
            'expense_proof.required' => 'Expense proof cant be empty, please insert',
            'description.required' => 'Please fill description'
        ]);

        if ($request->file('expense_proof')) {
            $file = $request->file('expense_proof');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $newName = Auth::user()->id . Carbon::now()->format('dmHis') . '.' . $extension;
            $destination = 'public/images/reimbursement-request';
            $save = $file->storeAs($destination, $newName);
        }

        // define filed date and filed time
        $date = Carbon::now()->format('d-M-Y');
        $time = Carbon::now()->format('H:i:s');

        // check if reimbursement for today exists or not
        $reimbursement = Reimbursement::where('filed_date', $date)->first();

        if ($reimbursement == null) {
            // create new reimbursement master for today (date)
            // find manager id
            $manager = User::select('id')
                ->where('role', 2)
                ->where('division', Auth::user()->division)
                ->first();

            $reimbursementMaster = Reimbursement::create([
                'status' => 'Pending',
                'total' => $request->amount_spent,
                'filed_date' => $date,
                'user_id' => Auth::user()->id,
                'manager_id' => $manager->id,
                'financial_admin_id' => null
            ]);
        } else {
            $reimbursement->total = $reimbursement->total + $request->amount_spent;
            $reimbursement->save();
        }

        // save reimbursement requests
        $reimbursementRequest = ReimbursementRequest::create([
            'expense_proof' => $save,
            'description' => $request->description,
            'amount_spent' => $request->amount_spent,
            'filed_date' => $date,
            'filed_time' => $time,
            'reimbursement_id' => $reimbursement != null ? $reimbursement->id : 
                ($reimbursementMaster != null ? $reimbursementMaster->id : null)
        ]);

        if ($reimbursementRequest) {
            return redirect()->route('employer.create')->with(['message' => 'SUCCESS Create Reimbursement.']);
        } else {
            return redirect()->back()->with(['message' => 'Save data failed, please try again later. Or contact IT Support.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Reimbursement::where('user_id', Auth::user()->id)
            ->first();

        $requests = ReimbursementRequest::where('filed_date', $data->filed_date)
            ->paginate(8);

        return view('pages.employer.detail-request', compact('data', 'requests'));
    }

    public function pending()
    {
        $bank_account = BankAccount::where('user_id', Auth::user()->id)->first();
        $data = Reimbursement::where('user_id', Auth::user()->id)
            ->where('status', 'Pending')
            ->paginate(8);

        return view('pages.index', compact('bank_account', 'data'));
    }

    public function rejected()
    {
        $bank_account = BankAccount::where('user_id', Auth::user()->id)->first();
        $data = Reimbursement::where('user_id', Auth::user()->id)
            ->where('status', 'Rejected')
            ->paginate(8);

        return view('pages.index', compact('bank_account', 'data'));
    }

    public function approved()
    {
        $bank_account = BankAccount::where('user_id', Auth::user()->id)->first();
        $data = Reimbursement::where('user_id', Auth::user()->id)
            ->where('status', 'Approved')
            ->paginate(8);

        return view('pages.index', compact('bank_account', 'data'));
    }

    public function processed()
    {
        $bank_account = BankAccount::where('user_id', Auth::user()->id)->first();
        $data = Reimbursement::where('user_id', Auth::user()->id)
            ->where('status', 'Processed')
            ->paginate(8);

        return view('pages.index', compact('bank_account', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }
}
