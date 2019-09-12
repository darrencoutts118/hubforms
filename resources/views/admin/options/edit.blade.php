@extends('layouts.admin')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        Edit Field: {{ $field->title }}
    </div>
    <div class="card-body">
        {!! form($editForm) !!}
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        Options
    </div>
    <div class="card-body">
    </div>
</div>

<div class="card">
    <div class="card-header">
        Validation Rules
    </div>
    <div class="card-body">
    </div>
</div>
@endsection
