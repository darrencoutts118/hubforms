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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Oops, something went wrong</strong></p>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{ $form->intro }}
                    {!! form($form->getBuilder()) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
