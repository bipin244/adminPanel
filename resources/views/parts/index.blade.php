@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <h1>Parts</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Parts</li>
    </ol>
</section>
<section class="content">
    @if(Session::has('message'))
        <div class="callout callout-success" id="success-alert">
            <h4>{{ Session::get('message') }}</h4>
        </div>
    @endif
    <div class="row addButton">
    <a href="{{ URL::route('parts.create') }}" class="btn btn-info pull-right btn-space" role="button"><i class="fa fa-plus"></i><span>Add parts</span></a>
    </div>
    <table class="table table-bordered table-hover" id="parts-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Average Price</th>
                <th>Sku</th>
                <th>Description</th>
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
    $('#parts-table').DataTable({
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
            url: '{{ route('parts.index') }}',
            type: "get",
            error: function (xhr, status, error) {
                console.log("error something wrong");
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'avg_price', name: 'avg_price' },
            { data: 'sku', name: 'sku' },
            { data: 'description', name: 'description' },
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