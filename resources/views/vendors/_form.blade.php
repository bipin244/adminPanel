<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name <span class="warning">*</span></label>
                {!! Form::text('name', isset($data) ? $data['name'] : '', array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name' )) !!}
            </div>
            <div class="form-group {{ $errors->has('contact_id') ? ' has-error' : '' }}">
                <label for="contact_id">Contact Name <span class="warning">*</span></label>
                {{ Form::select('contact_id', $contacts, isset($data) ? $data['	contact_id'] :null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name">Description <span class="warning">*</span></label>
                {{ Form::textarea('description', null,['class' => 'form-control','size' => '30x5','placeholder'=>'Description']) }}
            </div>
        </div>
    </div>
</div><!-- /.box-body -->
