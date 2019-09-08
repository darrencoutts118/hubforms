@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Create New Form
    </div>
    <div class="card-body">
        {!! form($createForm) !!}
    </div>
</div>
@endsection
