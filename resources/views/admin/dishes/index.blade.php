@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.dishes.create') }}" class="btn btn-success mr-1">{{ __('Add Dish') }}</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Ingredients</th>
            <th>Weight (g)</th>
            <th>Category</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dishes as $dish)
            <tr>
                <td>{{ $dish->id }}</td>
                <td><a href="{{ route('admin.dishes.show', $dish) }}">{{ $dish->name }}</a></td>
                <td>{{ $dish->ingredients }}</td>
                <td>{{ $dish->weight }}</td>
                <td><a href="{{ route('admin.categories.show', $dish->category) }}">{{ $dish->category->name }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $dishes->links() }}
@endsection