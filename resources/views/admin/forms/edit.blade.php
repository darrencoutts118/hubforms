@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Edit {{ $form->title }}
    </div>
    <div class="card-body">
        {!! form($editForm) !!}
    </div>
</div>
@endsection
