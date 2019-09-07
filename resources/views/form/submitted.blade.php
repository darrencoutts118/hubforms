@extends('app')

@section('content')
<div class="card">
    <div class="card-header">
        {{ $form->title }}
    </div>
    <div class="card-body">
        <div class="alert alert-success">
            <p><strong>Success</strong></p>
            <p>You have successfully submitted the form.</p>
        </div>
    </div>
</div>
@endsection
