@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        {{ $form->title }}: New Field
    </div>
    <div class="card-body">
        {!! form($createForm) !!}
    </div>
</div>
@endsection
