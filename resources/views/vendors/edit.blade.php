@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Vendor</div>
                <div class="panel-body">
                    {!! Form::model($data,["method"=>"PATCH","action"=> ['VendorController@update',$data["id"]]]) !!}
                        @include('vendors/_form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-save"></i> Update
                            </button>
                            <a href="{{ url('vendors') }}" class="btn btn-primary">
                                <i class="fa fa-btn fa-undo"></i> Cancel
                            </a>
                        </div>
                    {!!Form::close()!!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
