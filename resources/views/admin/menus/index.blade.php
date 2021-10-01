@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.menus.create') }}" class="btn btn-success mr-1">{{ __('Add to Menu') }}</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Ingredients</th>
                <th>Weight&nbsp;(g)</th>
                <th>Price</th>
                <th>Actual at</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td><a href="{{ route('admin.menus.show', $menu) }}">{{ $menu->dish->name }}</a></td>
                    <td>{{ $menu->dish->ingredients }}</td>
                    <td>{{ $menu->dish->weight }}</td>
                    <td>{{ $menu->price }}</td>
                    <td class="text-nowrap">{{ $menu->actual_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.categories.show', $menu->dish->category) }}">{{ $menu->dish->category->name }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $menus->links() }}
@endsection