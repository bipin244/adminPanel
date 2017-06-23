@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <h1>
    User
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">User</li>
    </ol>
</section>
<section class="content">
    @if(Session::has('message'))
        <div class="callout callout-success" id="success-alert">
            <h4>{{ Session::get('message') }}</h4>
        </div>
    @endif
    <div class="row addButton">
    <a href="{{ URL::route('user.create') }}" class="btn btn-info pull-right btn-space" role="button"><i class="fa fa-plus"></i><span>Add User</span></a>
    </div>
    <table class="table table-bordered table-hover" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Title</th>
                <th>Phone</th>
                <th>Active</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</section>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        ajax: {
            url: '{{ route('user.index') }}',
            type: "get",
            error: function (xhr, status, error) {
                console.log("error something wrong");
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'title', name: 'title' },
            { data: 'phone', name: 'phone' },
            { data: 'active', name: 'active' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush