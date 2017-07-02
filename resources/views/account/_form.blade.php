<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name <span class="warning">*</span></label>
                {!! Form::text('name', isset($data) ? $data['name'] : '', array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name' )) !!}
            </div>
        </div>
    </div>
</div><!-- /.box-body -->
