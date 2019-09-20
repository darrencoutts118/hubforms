@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
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
        </div>
    </div>
</div>
@endsection
