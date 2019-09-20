@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Forms
        <a href="{{ route('admin.forms.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> New Form</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm">
            <tr>
                <th>Title</th>
                <th># of responses</th>
                <th>Created</th>
                <th>Options</th>
            </tr>
            @foreach ($forms as $form)
            <tr>
                <td>{{ $form->title }}</td>
                <td>{{ $form->submissions()->count() }}</td>
                <td>{{ $form->created_at }}</td>
                <td><a href="{{ route('admin.forms.show', $form) }}">Edit Form</a></td>
            </tr>
            @endforeach
        </table>
        {{ $forms->links() }}
    </div>
</div>
@endsection
