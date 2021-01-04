<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

// models
use App\Models\Reimbursement;
use App\Models\ReimbursementRequest;

class ManagerController extends Controller
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

    //  show detail of reimbursement on dashboard
    public function show($id)
    {
        // fetch reimbursement data
        $data = Reimbursement::where('id', $id)->with('employer')->first();
        $requests = ReimbursementRequest::where('reimbursement_id', $data->id)->orderBy('id', 'asc')->paginate(8);
        
        return view('pages.manager.detail-request', compact('data', 'requests'));
    }

    public function pending()
    {
        $data = Reimbursement::where('manager_id', Auth::user()->id)
            ->with('employer')
            ->where('status', 'Pending')
            ->paginate(8);

        return view('pages.index', compact('data'));
    }

    public function rejected()
    {
        $data = Reimbursement::where('manager_id', Auth::user()->id)
            ->with('employer')
            ->where('status', 'Rejected')
            ->paginate(8);

        return view('pages.index', compact('data'));
    }

    public function approved()
    {
        $data = Reimbursement::where('manager_id', Auth::user()->id)
            ->with('employer')
            ->where('status', 'Approved')
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
        // function update status of reimbursement request
        $reimbursement = Reimbursement::where('id', $id)->first();
        $reimbursement->status = $request->status;
        $update = $reimbursement->save();

        if ($update) {
            return redirect()->route('dashboard')->with(['message' => 'Reimbursement Status Updated!']);
        } else {
            return redirect()->route('dashboard')->with(['message' => 'Failed to Update Reimbursement Status']);
        }
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
