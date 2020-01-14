@extends('layouts.admin')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        View Version
    </div>
    <div class="card-body">
        {!! dump($diff) !!}

        <div class="mt-3">
            <a href="{{ route('version.approve', $version) }}" class="btn btn-primary">Approve Version</a>
            <a href="{{ route('version.revert', $version) }}" class="btn btn-secondary">Revert to Version</a>
        </div>
    </div>
</div>
@endsection
