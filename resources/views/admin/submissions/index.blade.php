@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <p>{{ $form->title }}: Submissions</p>
        @include('admin.forms.menu', ['active' => 'submissions'])
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm">
            <tr>
                @foreach($fields as $field)
                <th>{{ $field->title }}</th>
                @endforeach
                <th></th>
            </tr>
            @foreach ($submissions as $submission)
            <tr>
                @foreach($fields as $field)
                <td>{{ $submission->{$field->name} }}</td>
                @endforeach
                <td><a href="{{ route('admin.submissions.show', [$form, $submission]) }}">View</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
