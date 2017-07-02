<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Auth;
use Yajra\Datatables\Datatables;
use Session;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Account::leftJoin('users as create', function($join) {
                        $join->on('accounts.created_id', '=', 'create.id');
                    })->
                    leftJoin('users as modify', function($join) {
                        $join->on('accounts.modified_id', '=', 'modify.id');
                    })->get(['accounts.*',\DB::raw("CONCAT(create.first_name,' ',create.last_name)  AS createrName"),\DB::raw("CONCAT(modify.first_name,' ',modify.last_name)  AS modifierName")]);
            // echo "<pre>";print_r($data);exit;
            return Datatables::of($data)
                ->addColumn('action', '<a class="editRecord" href="{{ URL::route( \'account.edit\', array( $id )) }}"> <i class="fa fa-fw fa-pencil"></i></a><a class="deleteRecord" href="{{ URL::route( \'account.destroy\', array( $id.\'/delete\' )) }}"> <i class="fa fa-fw fa-close"></i></a>')
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('account/index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $rules= [
            'name' => 'required|max:255'
        ];
        $this->validate($request,$rules);
        $data = new Account();
        $data['name'] = $inputs['name'];
        $data['created_id'] = Auth::user()->id;
        if ($data->save()) {
            Session::flash('message', 'Account Created Successfully');
            return redirect("account");
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
        $userData = Account::find($id);
        return view('account/edit', ['data' => $userData]);
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
        $inputs = $request->all();
        $rules= [
            'name' => 'required|max:255'
        ];
        $this->validate($request,$rules);
        $data = Account::findOrFail($id);
        $inputs['name'] = $inputs['name'];
        $inputs['modified_id'] =  Auth::user()->id;
        // $inputs['updated_at'] = date('Y-m-d H:i:s');
        if ($data->update($inputs)) {
            Session::flash('message', 'Account Updated Successfully');
            return redirect("account");
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

    public function delete($id){
        $user = Account::find($id);
        if ($user->delete()) {
            Session::flash('message', 'Account Deleted Successfully');
            return redirect("account");
        }
    }
}
