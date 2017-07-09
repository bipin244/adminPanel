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
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                <label for="sku">Sku <span class="warning">*</span></label>
                {!! Form::number('sku', isset($data) ? $data['sku'] : '', array('class' => 'form-control', 'id' => 'sku', 'placeholder' => 'Sku' ,'required' => 'required')) !!}
            </div>
            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name">Description <span class="warning">*</span></label>
                {!! Form::textarea('description', null,['class' => 'form-control','size' => '30x5','placeholder'=>'Description','required' => 'required']) !!}
            </div>
            
        </div>
    </div>
</div><!-- /.box-body -->
