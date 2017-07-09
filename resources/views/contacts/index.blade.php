@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <h1>Contacts</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Contacts</li>
    </ol>
</section>
<section class="content">
    @if(Session::has('message'))
        <div class="callout callout-success" id="success-alert">
            <h4>{{ Session::get('message') }}</h4>
        </div>
    @endif
    <div class="row addButton">
    <a href="{{ URL::route('contacts.create') }}" class="btn btn-info pull-right btn-space" role="button"><i class="fa fa-plus"></i><span>Add contacts</span></a>
    </div>
    <table class="table table-bordered table-hover" id="contacts-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Account Name</th>
                <th>Company</th>
                <th>Title</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Creater Name</th>
                <th>Created At</th>
                <th>Modifier Name</th>
                <th>Modified At</th>
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
    $('#contacts-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        ajax: {
            url: '{{ route('contacts.index') }}',
            type: "get",
            error: function (xhr, status, error) {
                console.log("error something wrong");
            }
        },
        columns: [
             { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'account_name', name: 'account_name' },
            { data: 'company', name: 'company' },
            { data: 'title', name: 'title' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'createrName', name: 'createrName' },
            { data: 'created_at', name: 'created_at' },
            { data: 'modifierName', name: 'modifierName' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush