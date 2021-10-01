@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-primary mr-1">{{ __('Edit') }}</a>
        <form method="POST" action="{{ route('admin.dishes.destroy', $dish) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $dish->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $dish->name }}</td>
            </tr>
            <tr>
                <th>Ingredients</th>
                <td>{{ $dish->ingredients }}</td>
            </tr>
            <tr>
                <th>Weight (g)</th>
                <td>{{ $dish->weight }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td><a href="{{ route('admin.categories.show', $dish->category) }}">{{ $dish->category->name }}</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <p><a href="{{ route('admin.categories.create') }}" class="btn btn-success">Add Category</a></p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="4">Category</th>
            </tr>
            <tr>
                <th>ID</th>
                <td>{{ $dish->category->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td><a href="{{ route('admin.categories.show', $dish->category) }}">{{ $dish->category->name }}</a></td>
            </tr>
            <tr>
                <th>Created at</th>
                <td>{{ $dish->category->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            <tr>
                <th>Updated at</th>
                <td>{{ $dish->category->updated_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            </thead>
        </table>
    </div>
@endsection