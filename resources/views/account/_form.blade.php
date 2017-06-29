<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name">First Name <span class="warning">*</span></label>
                {!! Form::text('first_name', isset($data) ? $data['first_name'] : '', array('class' => 'form-control', 'id' => 'first_name', 'placeholder' => 'First Name' )) !!}
            </div>
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email <span class="warning">*</span></label>
                {!! Form::text('email', isset($data) ? $data['email'] : '', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email' )) !!}
            </div>
            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone">Phone <span class="warning">*</span></label>
                {!! Form::text('phone', isset($data) ? $data['phone'] : '', array('class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone' )) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name">Last Name <span class="warning">*</span></label>
                {!! Form::text('last_name', isset($data) ? $data['last_name'] : '', array('class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Last Name' )) !!}
            </div>
            
            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title">Title <span class="warning">*</span></label>
                {!! Form::text('title', isset($data) ? $data['title'] : '', array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title' )) !!}
            </div>
            @if(!isset($data))
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password <span class="warning">*</span></label>
                    {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password')) }}
                </div>
            @endif
        </div>
    </div>
</div><!-- /.box-body -->
