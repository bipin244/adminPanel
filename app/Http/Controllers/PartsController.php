<?php

namespace App\Http\Controllers;

use App\Parts;
use App\Vendor;
use App\PartToVendor;
use Illuminate\Http\Request;
use Auth;
use Yajra\Datatables\Datatables;
use Session;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Parts::leftJoin('users as create', function($join) {
                        $join->on('parts.created_id', '=', 'create.id');
                    })->
                    leftJoin('users as modify', function($join) {
                        $join->on('parts.modified_id', '=', 'modify.id');
                    })->get(['parts.*',\DB::raw("CONCAT(create.first_name,' ',create.last_name)  AS createrName"),\DB::raw("CONCAT(modify.first_name,' ',modify.last_name)  AS modifierName")]);
            // echo "<pre>";print_r($data);exit;
            return Datatables::of($data)
                ->addColumn('action', '<a class="editRecord" href="{{ URL::route( \'parts.edit\', array( $id )) }}"> <i class="fa fa-fw fa-pencil"></i></a><a class="deleteRecord" href="{{ URL::route( \'parts.destroy\', array( $id.\'/delete\' )) }}"> <i class="fa fa-fw fa-close"></i></a>')
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('parts/index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::pluck('name', 'id');
        return view('parts/create',compact('vendors'));
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
            'sku' => 'required',
            'description' => 'required',
            'avg_price' => 'required|numeric',
            'vendors'=>'required'
        ];
        $this->validate($request,$rules);
        $data = new Parts();
        $data['name'] = $inputs['name'];
        $data['sku'] = $inputs['sku'];
        $data['description'] = $inputs['description'];
        $data['avg_price'] = $inputs['avg_price'];
        $data['created_id'] = Auth::user()->id;
        if ($data->save()) {
            \DB::table('parts_to_vendor')->insert(
                ['part_id' => $data->id, 'vendor_id' => implode (", ",$inputs['vendors']),'created_at'=>date('Y-m-d H:i:s')]
            );
            Session::flash('message', 'Parts Created Successfully');
            return redirect("parts");
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
        $userData = Parts::leftJoin('parts_to_vendor', function($join) {
                        $join->on('parts.id', '=', 'parts_to_vendor.part_id');
                    })
                    ->where('parts.id',$id)
                    ->get(['parts.*','parts_to_vendor.vendor_id as vendors']);
        $userData[0]['vendors'] = explode(',',$userData[0]['vendors']);
        $vendors = Vendor::pluck('name', 'id');
        return view('parts/edit', ['data' => $userData[0],'vendors'=>$vendors]);
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
            'sku' => 'required',
            'description' => 'required',
            'avg_price' => 'required|numeric',
            'vendors'=>'required'
        ];
        $this->validate($request,$rules);
        $data = Parts::findOrFail($id);
        $inputs['name'] = $inputs['name'];
         $data['sku'] = $inputs['sku'];
        $data['description'] = $inputs['description'];
        $data['avg_price'] = $inputs['avg_price'];
        $inputs['modified_id'] =  Auth::user()->id;
        // $inputs['updated_at'] = date('Y-m-d H:i:s');
        if ($data->update($inputs)) {
            PartToVendor::updateOrCreate(
                ['part_id' => $id],[ 'vendor_id' => implode (",",$inputs['vendors'])]
            );
            Session::flash('message', 'Parts Updated Successfully');
            return redirect("parts");
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
        $user = Parts::find($id);
        if ($user->delete()) {
            Session::flash('message', 'Parts Deleted Successfully');
            return redirect("parts");
        }
    }
}