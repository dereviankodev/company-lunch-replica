@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary mr-1">{{ __('Edit') }}</a>
        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $category->name }}</td>
        </tr>
        <tr>
        <tr>
            <th>Created at</th>
            <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
        <tr>
            <th>Updated at</th>
            <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
        </tbody>
    </table>
@endsection