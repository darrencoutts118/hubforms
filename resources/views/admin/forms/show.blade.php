@extends('layouts.admin')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <p>{{ $form->title }}</p>
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="fa fa-sticky-note"></i> Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-pen"></i> Submissions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-align-justify"></i> Fields</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-play-circle"></i> Actions</a>
            </li>
        </ul>
    </div>
    <div class="card-body text-center">
        <div class="row">
            <div class="col-md-4">
                <span class="h1 strong">{{ $form->created_at->diffForHumans() }}</span>
                <div class="strong">Created</div>
            </div>
            <div class="col-md-4">
                <span class="h1 strong">{{ $form->submissions()->count() }}</span>
                <div class="strong">Submissions</div>
            </div>
            <div class="col-md-4">
                <span
                    class="h1 strong">{{ $form->submissions()->latest()->first() ? $form->submissions()->latest()->first()->created_at->diffForHumans() : 'N/A'  }}</span>
                <div class="strong">Last Submission</div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Recent Submimssions
    </div>
    <div class="card-body">
        @if(empty($form->submissions()->count()))
        <div class="text-center">
            <h5 class="card-title">No Submissions</h5>
            <p class="card-text">This form has no submissions. Try sharing the form to get your first.</p>
            <a href="{{ route('form', $form) }}" class="btn btn-primary">View Form</a>
        </div>
        @else
        {{ $form->submissions->count() }}
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header text-white bg-danger">
        Danger Zone!
    </div>
    <div class="card-body">
        <h5 class="card-title">Delete All Submissions</h5>
        <p class="card-text">This will remove all submissions from the system.</p>
        <form action="#" method="POST">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-danger" value="Delete Submissions" />
        </form>

        <hr />

        <h5 class="card-title">Delete Form</h5>
        <p class="card-text">If you delete the form, all of the submissions stored will also be deleted.</p>
        <form action="#" method="POST">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-danger" value="Delete Form" />
        </form>
    </div>
</div>

@endsection
