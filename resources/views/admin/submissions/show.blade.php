@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <p>{{ $form->title }}: Submissions</p>
        @include('admin.forms.menu', ['active' => 'submissions'])
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm">
            @foreach ($form->fields as $field)
            <tr>
                <th width="33%">{{ $field->title }}</th>
                <td>{{ $submission->{$field->name} }}</td>
            </tr>
            @endforeach
        </table>
        <form action="{{ route('admin.submissions.destroy', [$form, $submission]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="Delete Submission" class="btn btn-outline-danger" />
        </form>
    </div>
</div>
@endsection
