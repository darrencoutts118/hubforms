@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <p>{{ $form->title }}</p>
        <a href="{{ route('admin.options.create', [$form, $field]) }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> New Field</a>
        @include('admin.forms.menu', ['active' => 'fields'])
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm">
            <tr>
                <th>Value</th>
                <th>Display</th>
                <th>Options</th>
            </tr>
            @foreach ($options as $option)
            <tr>
                <td>{{ $option->value }}</td>
                <td>{{ $option->title }}</td>
                <td>
                    <a href="{{ route('admin.options.edit', [$form, $field, $option]) }}">Move Up</a> |
                    <a href="{{ route('admin.options.edit', [$form, $field, $option]) }}">Move Down</a> |
                    <a href="{{ route('admin.options.edit', [$form, $field, $option]) }}">Edit Field</a> |
                    <form action="{{ route('admin.options.destroy', [$form, $field, $option]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-link" value="Delete Field">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $options->links() }}
    </div>
</div>
@endsection
