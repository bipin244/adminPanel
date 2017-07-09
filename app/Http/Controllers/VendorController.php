<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Contacts;
use Illuminate\Http\Request;
use Auth;
use Yajra\Datatables\Datatables;
use Session;
class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vendor::leftJoin('users as create', function($join) {
                        $join->on('vendors.created_id', '=', 'create.id');
                    })->
                    leftJoin('users as modify', function($join) {
                        $join->on('vendors.modified_id', '=', 'modify.id');
                    })->
                    leftJoin('contacts', function($join) {
                        $join->on('contacts.id', '=', 'vendors.contact_id');
                    })->get(['vendors.*','contacts.first_name as contactName',\DB::raw("CONCAT(create.first_name,' ',create.last_name)  AS createrName"),\DB::raw("CONCAT(modify.first_name,' ',modify.last_name)  AS modifierName")]);
            // echo "<pre>";print_r($data);exit;
            return Datatables::of($data)
                ->addColumn('action', '<a class="editRecord" href="{{ URL::route( \'vendors.edit\', array( $id )) }}"> <i class="fa fa-fw fa-pencil"></i></a><a class="deleteRecord" href="{{ URL::route( \'vendors.destroy\', array( $id.\'/delete\' )) }}"> <i class="fa fa-fw fa-close"></i></a>')
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('vendors/index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacts = Contacts::pluck('first_name', 'id');
        return view('vendors/create',compact('contacts'));
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
            'name' => 'required|max:255',
            'contact_id' => 'required',
            'description' => 'required'
        ];
        $this->validate($request,$rules);
        $data = new Vendor();
        $data['name'] = $inputs['name'];
        $data['contact_id'] = $inputs['contact_id'];
        $data['description'] = $inputs['description'];
        $data['created_id'] = Auth::user()->id;
        if ($data->save()) {
            Session::flash('message', 'Vendor Created Successfully');
            return redirect("vendors");
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
        $contacts = Contacts::pluck('first_name', 'id');
        $userData = Vendor::find($id);
        return view('vendors/edit', ['data' => $userData,'contacts'=>$contacts]);
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
            'name' => 'required|max:255',
            'contact_id' => 'required',
            'description' => 'required'
        ];
        $this->validate($request,$rules);
        $data = Vendor::findOrFail($id);
        $inputs['name'] = $inputs['name'];
        $inputs['contact_id'] = $inputs['contact_id'];
        $inputs['description'] = $inputs['description'];
        $inputs['modified_id'] =  Auth::user()->id;
        if ($data->update($inputs)) {
            Session::flash('message', 'Vendor Updated Successfully');
            return redirect("vendors");
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
        $user = Vendor::find($id);
        if ($user->delete()) {
            Session::flash('message', 'Vendor Deleted Successfully');
            return redirect("vendors");
        }
    }
}
