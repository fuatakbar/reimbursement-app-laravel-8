<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

// models
use App\Models\BankAccount;
use App\Models\Reimbursement;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        if (Auth::user()->role == 1) {
            # code...
        } elseif (Auth::user()->role == 2) {
            $data = Reimbursement::where('manager_id', Auth::user()->id)
                ->with('employer')
                ->orderBy('id', 'asc')
                ->paginate(8);

            return view('pages.index', compact('data')); 
        } elseif (Auth::user()->role == 3) {
            // 
        } elseif (Auth::user()->role == 4) {
            $bank_account = BankAccount::where('user_id', Auth::user()->id)->first();
            $data = Reimbursement::where('user_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(8);

            if ($bank_account == null) {
                $must_fill_bank = true;

                return view('pages.index', compact('must_fill_bank'));
            } else {
                return view('pages.index', compact('bank_account', 'data'));
            }
        }

        return view('pages.index');
        
    }
}
