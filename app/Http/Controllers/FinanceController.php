<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Log;

// models
use App\Models\Reimbursement;
use App\Models\ReimbursementRequest;

class FinanceController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // fetch reimbursement data
        $data = Reimbursement::where('id', $id)->with('employer')->first();
        $requests = ReimbursementRequest::where('reimbursement_id', $data->id)->orderBy('id', 'asc')->paginate(8);
        
        return view('pages.finance.detail-request', compact('data', 'requests'));
    }

    public function processed()
    {
        $data = Reimbursement::where('financial_admin_id', Auth::user()->id)
            ->with('employer')
            ->where('status', 'Processed')
            ->paginate(8);

        return view('pages.index', compact('data'));
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
        $request->validate([
            'transfer_proof' => 'mimes:jpg,jpeg,png|max:2048|required'
        ], [
            'transfer_proof.mimes' => 'Please choose valid image file type (must jpg, jpeg).',
            'transfer_proof.max' => 'Image file must be lower than 2MB',
            'transfer_proof.required' => 'Expense proof cant be empty, please insert'
        ]);

        // this to update reimbursement status when transfer proof uploaded
        $reimbursement = Reimbursement::where('id', $id)->first();

        if ($request->file('transfer_proof')) {
            $file = $request->file('transfer_proof');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $newName = Auth::user()->id . Carbon::now()->format('dmHis') . '-' . $reimbursement->id . '.' . $extension;
            $destination = 'public/images/transfer_proof';
            $save = $file->storeAs($destination, $newName);
        }

        try {
            $reimbursement->transfer_proof = $save;
            $reimbursement->status = 'Processed';
            $reimbursement->financial_admin_id = Auth::user()->id;
            $reimbursement->save();

            return redirect()->route('dashboard')->with(['message' => 'Thank you for processing the return. Returns successful!']);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with(['message' => 'Something wrong! Please try again.']);
        };

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
