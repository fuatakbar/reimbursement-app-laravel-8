<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
use Storage;
use Hash;
use Carbon\Carbon;

// models
use App\Models\User;
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
            'expense_proof' => 'mimes:jpg,jpeg,png|max:2048|required'
        ], [
            'expense_proof.mimes' => 'Please choose valid image file type (must jpg, jpeg).',
            'expense_proof.max' => 'Image file must be lower than 2MB',
            'expense_proof.required' => 'Expense proof cant be empty, please insert'
        ]);

        // if ($request->file('expense_proof')) {
        //     $file = $req->file('expense_proof');
        //     $filename = $file->getClientOriginalName();
        //     $extension = $file->getClientOriginalExtension();
        //     $newName = Auth::user()->id . Carbon::now()->format('dmHis') . '.' . $extension;
        //     $destination = 'public/images/reimbursement-request';
        //     $save = $file->storeAs($destination, $newName);
        // }

        // define filed date and filed time
        $date = Carbon::now()->format('d M Y');
        $time = Carbon::now()->format('H:i');

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
                'filed_date' => $date,
                'user_id' => Auth::user()->id,
                'manager_id' => $manager->id
            ]);

            return $reimbursementMaster;
        }

        // save reimbursement requests

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
