<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name <span class="warning">*</span></label>
                {!! Form::text('name', isset($data) ? $data['name'] : '', array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name' ,'required' => 'required')) !!}
            </div>
            <div class="form-group {{ $errors->has('avg_price') ? ' has-error' : '' }}">
                <label for="avg_price">Average Price <span class="warning">*</span></label>
                {!! Form::number('avg_price', isset($data) ? $data['avg_price'] : '', array('class' => 'form-control', 'id' => 'avg_price', 'placeholder' => 'Average Price','step'=>'0.01' ,'required' => 'required')) !!}
            </div>
           
            <div class="form-group {{ $errors->has('vendors') ? ' has-error' : '' }}">
                <label for="vendors">Vendor <span class="warning">*</span></label>
                <select class="form-control" name="vendors[]" multiple>
                    @foreach ($vendors as $key => $vendor)
                        <option value="{{$key}}" @if(isset($data)) @if (in_array($key,$data['vendors'])) selected @endif @endif>{{ $vendor }}</option>
                    @endforeach
                </select>
                <!--{!! Form::select('vendors[]', $vendors, isset($data) ? [4] : null, ['multiple' => true, 'class' => 'form-control']) !!}-->
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                <label for="sku">Sku <span class="warning">*</span></label>
                {!! Form::number('sku', isset($data) ? $data['sku'] : '', array('class' => 'form-control', 'id' => 'sku', 'placeholder' => 'Sku' ,'step'=>'1','min'=>'0' ,'required' => 'required')) !!}
            </div>
            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name">Description <span class="warning">*</span></label>
                {!! Form::textarea('description', null,['class' => 'form-control','size' => '30x5','placeholder'=>'Description','required' => 'required']) !!}
            </div>
            
        </div>
    </div>
</div><!-- /.box-body -->
