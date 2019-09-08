@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <p>{{ $form->title }}</p>
        <a href="{{ route('admin.fields.create', $form) }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> New Field</a>
        @include('admin.forms.menu', ['active' => 'fields'])
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm">
            <tr>
                <th>Title</th>
                <th>Name</th>
                <th>Type</th>
                <th>Options</th>
            </tr>
            @foreach ($fields as $field)
            <tr>
                <td>{{ $field->title }}</td>
                <td>{{ $field->name }}</td>
                <td>{{ $field->type }}</td>
                <td>
                    <a href="{{ route('admin.fields.edit', [$form, $field]) }}">Move Up</a> |
                    <a href="{{ route('admin.fields.edit', [$form, $field]) }}">Move Down</a> |
                    <a href="{{ route('admin.fields.edit', [$form, $field]) }}">Edit Field</a> |
                    <form action="{{ route('admin.fields.destroy', [$form, $field]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-link" value="Delete Field">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $fields->links() }}
    </div>
</div>
@endsection
