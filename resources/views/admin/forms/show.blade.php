@extends('layouts.admin')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <p>{{ $form->title }}</p>
        @include('admin.forms.menu', ['active' => 'overview'])
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
        <p><a href="{{ route('admin.forms.edit', $form) }}">Edit Form</a></p>
    </div>
</div>

<div class="card mb-3">
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
        <table class="table table-striped table-sm">
            <tr>
                @foreach($form->fields->take(3) as $field)
                <th>{{ $field->title }}</th>
                @endforeach
                <th></th>
            </tr>
            @foreach ($form->submissions->take(5) as $submission)
            <tr>
                @foreach($form->fields->take(3) as $field)
                <td>{{ $submission->{$field->name} }}</td>
                @endforeach
                <td><a href="{{ route('admin.submissions.show', [$form, $submission]) }}">View</a></td>
            </tr>
            @endforeach
        </table>
        <a href="{{ route('admin.submissions.index', $form) }}" class="btn btn-primary btn-sm">View All Submissions</a>
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
            <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete Submissions" />
        </form>

        <hr />

        <h5 class="card-title">Delete Form</h5>
        <p class="card-text">If you delete the form, all of the submissions stored will also be deleted.</p>
        <form action="#" method="POST">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete Form" />
        </form>
    </div>
</div>

@endsection
