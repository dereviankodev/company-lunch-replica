@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-primary mr-1">{{ __('Edit') }}</a>
        <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" class="mr-1">
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
                <td>{{ $menu->id }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>{{ $menu->price }} uah</td>
            </tr>
            <tr>
                <th>Actual at</th>
                <td>{{ $menu->actual_at->format('Y-m-d') }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <p><a href="{{ route('admin.dishes.create') }}" class="btn btn-success">Add Dish</a></p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="4">Dish</th>
            </tr>
            <tr>
                <th>ID</th>
                <td>{{ $menu->dish->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td><a href="{{ route('admin.dishes.show', $menu->dish) }}">{{ $menu->dish->name }}</a></td>
            </tr>
            <tr>
                <th>Ingredients</th>
                <td>{{ $menu->dish->ingredients }}</td>
            </tr>
            <tr>
                <th>Weight (g)</th>
                <td>{{ $menu->dish->weight }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>
                    <a href="{{ route('admin.categories.show', $menu->dish->category) }}">{{ $menu->dish->category->name }}</a>
                </td>
            </tr>
            <tr>
                <th>Created at</th>
                <td>{{ $menu->dish->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            <tr>
                <th>Updated at</th>
                <td>{{ $menu->dish->updated_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            </thead>
        </table>
    </div>
@endsection