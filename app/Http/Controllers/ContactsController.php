<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\Account;
use Illuminate\Http\Request;
use Auth;
use Yajra\Datatables\Datatables;
use Session;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contacts::leftJoin('users as create', function($join) {
                        $join->on('contacts.created_id', '=', 'create.id');
                    })->
                    leftJoin('users as modify', function($join) {
                        $join->on('contacts.modified_id', '=', 'modify.id');
                    })->
                    leftJoin('accounts', function($join) {
                        $join->on('contacts.account_id', '=', 'accounts.id');
                    })->get(['contacts.*','accounts.name as account_name',\DB::raw("CONCAT(create.first_name,' ',create.last_name)  AS createrName"),\DB::raw("CONCAT(modify.first_name,' ',modify.last_name)  AS modifierName")]);
            // echo "<pre>";print_r($data);exit;
            return Datatables::of($data)
                ->addColumn('action', '<a class="editRecord" href="{{ URL::route( \'contacts.edit\', array( $id )) }}"> <i class="fa fa-fw fa-pencil"></i></a><a class="deleteRecord" href="{{ URL::route( \'contacts.destroy\', array( $id.\'/delete\' )) }}"> <i class="fa fa-fw fa-close"></i></a>')
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('contacts/index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::pluck('name', 'id');
        return view('contacts/create',compact('accounts'));
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'account_id' => 'required',
            'title' => 'required|max:255',
            'company' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
        ];
        $this->validate($request,$rules);
        $data = new Contacts();
        $data['first_name'] = $inputs['first_name'];
        $data['last_name'] = $inputs['last_name'];
        $data['account_id'] = $inputs['account_id'];
        $data['title'] = $inputs['title'];
        $data['company'] = $inputs['company'];
        $data['phone'] = $inputs['phone'];
        $data['email'] = $inputs['email'];
        $data['created_id'] = Auth::user()->id;
        if ($data->save()) {
            Session::flash('message', 'Contacts Created Successfully');
            return redirect("contacts");
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
        $accounts = Account::pluck('name', 'id');
        $userData = Contacts::find($id);
        return view('contacts/edit', ['data' => $userData,'accounts'=>$accounts]);
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'account_id' => 'required',
            'title' => 'required|max:255',
            'company' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
        ];
        $this->validate($request,$rules);
        $data = Contacts::findOrFail($id);
        $data['first_name'] = $inputs['first_name'];
        $data['last_name'] = $inputs['last_name'];
        $data['account_id'] = $inputs['account_id'];
        $data['title'] = $inputs['title'];
        $data['company'] = $inputs['company'];
        $data['phone'] = $inputs['phone'];
        $data['email'] = $inputs['email'];
        $inputs['modified_id'] =  Auth::user()->id;
        // $inputs['updated_at'] = date('Y-m-d H:i:s');
        if ($data->update($inputs)) {
            Session::flash('message', 'Contacts Updated Successfully');
            return redirect("contacts");
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
        $user = Contacts::find($id);
        if ($user->delete()) {
            Session::flash('message', 'Contacts Deleted Successfully');
            return redirect("contacts");
        }
    }
}
