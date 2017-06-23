<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(User::get())
                ->addColumn('action', '<a class="editRecord" href="{{ URL::route( \'user.edit\', array( $id )) }}"> <i class="fa fa-fw fa-pencil"></i></a><a class="deleteRecord" href="{{ URL::route( \'user.destroy\', array( $id.\'/delete\' )) }}"> <i class="fa fa-fw fa-close"></i></a>')
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('user/index');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
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
            'email' => 'unique:users|required|email|max:255',
            'password' => 'required|min:6',
            'title' => 'required|max:255',
            'phone' => 'required|max:255',
        ];
        $this->validate($request,$rules);
        $data = new User();
        $data['first_name'] = $inputs['first_name'];
        $data['last_name'] = $inputs['last_name'];
        $data['email'] = $inputs['email'];
        $data['title'] = $inputs['title'];
        $data['phone'] = $inputs['phone'];
        $data['password'] = Hash::make($inputs['password']);
        if ($data->save()) {
            Session::flash('message', 'User Created Successfully');
            return redirect("user");
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
        $userData = User::find($id);
        return view('user/edit', ['data' => $userData]);
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
            'email' => 'unique:users,email,' . $id . ',id|required|email|max:255',
            'title' => 'required|max:255',
            'phone' => 'required|max:255',
        ];
        $this->validate($request,$rules);
        $data = User::findOrFail($id);
        $inputs['first_name'] = $inputs['first_name'];
        $inputs['last_name'] = $inputs['last_name'];
        $inputs['email'] = $inputs['email'];
        $inputs['title'] = $inputs['title'];
        $inputs['phone'] = $inputs['phone'];
        // $inputs['updated_at'] = date('Y-m-d H:i:s');
        if ($data->update($inputs)) {
            Session::flash('message', 'User Updated Successfully');
            return redirect("user");
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
        $user = User::find($id);
        if ($user->delete()) {
            Session::flash('message', 'User Deleted Successfully');
            return redirect("user");
        }
    }
}
