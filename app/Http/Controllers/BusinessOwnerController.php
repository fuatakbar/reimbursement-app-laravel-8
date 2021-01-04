<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

// models
use App\Models\User;
use App\Models\Role;
use App\Models\Division;

class BusinessOwnerController extends Controller
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

    public function employer(){
        $data = User::where('role', 4)
            ->with('divisions')
            ->orderBy('firstname', 'asc')
            ->paginate(10);
        
        return view('pages.owner.user-table', compact('data'));
    }

    public function manager(){
        $data = User::where('role', 2)
            ->with('divisions')
            ->orderBy('firstname', 'asc')
            ->paginate(10);
        
        return view('pages.owner.user-table', compact('data'));
    }

    public function finance(){
        $data = User::where('role', 3)
            ->with('divisions')
            ->orderBy('firstname', 'asc')
            ->paginate(10);
        
        return view('pages.owner.user-table', compact('data'));
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
        $user = User::where('id', $id)->first();
        $roles = Role::orderBy('name', 'asc')->get();
        $divisions = Division::orderBy('name', 'asc')->get();

        if ($user) {
            return view('pages.owner.edit-user', compact('user', 'roles', 'divisions'));
        } else {
            return redirect()->back()->with(['message' => 'Failure!']);
        }
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
        $user = User::where('id', $id)->first();

        try {

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->role = $request->role;
            $user->division = $request->division;
            $user->save();

            return redirect()->route('user.edit', [$id])->with(['message' => 'Data Updated Successfully!']);
        } catch (\Throwable $th) {
            return redirect()->route('user.edit', [$id])->with(['message' => 'Update Data Failed!']);
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
        $user = User::where('id', $id)->first();

        try {
            $delete = $user->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Cant Delete This User']);
        }
    }
}
