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
            <th>Created at</th>
            <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
            <th>Updated at</th>
            <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        </tbody>
    </table>

    <p><a href="{{ route('admin.dishes.create') }}" class="btn btn-success">Add Dish</a></p>

    <table class="table table-bordered">
        <thead>
        <tr><th colspan="4">Dishes</th></tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Ingredients</th>
            <th>Weight (g)</th>
        </tr>
        </thead>
        <tbody>

        @forelse($category->dishes as $dish)
            <tr>
                <td>{{ $dish->id }}</td>
                <td><a href="{{ route('admin.dishes.show', $dish) }}">{{ $dish->name }}</a></td>
                <td>{{ $dish->ingredients }}</td>
                <td>{{ $dish->weight }}</td>
            </tr>
        @empty
            <tr><td colspan="4">None</td></tr>
        @endforelse

        </tbody>
    </table>
@endsection