@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">{{ __('Edit') }}</a>
        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>
                @if ($user->isAdmin())
                    <span class="badge badge-danger">Admin</span>
                @else
                    <span class="badge badge-secondary">User</span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>

{{--    <p><a href="" class="btn btn-success">Cart</a></p>--}}

    <table class="table table-bordered">
        <thead>
        <tr><th colspan="5">Cart positions</th></tr>
        <tr>
            <th>Category</th>
            <th>Dish</th>
            <th>Ingredients</th>
            <th>Weight (g)</th>
            <th>Price</th>
            <th>Count</th>
        </tr>
        </thead>
        <tbody>

        @forelse($user->carts as $cart)
            <tr>
                <td>{{ $cart->menu->dish->category->name }}</td>
                <td>{{ $cart->menu->dish->name }}</td>
                <td>{{ $cart->menu->dish->ingredients }}</td>
                <td>{{ $cart->menu->dish->weight }}</td>
                <td>{{ $cart->menu->price }}</td>
                <td>{{ $cart->count }}</td>
            </tr>
        @empty
            <tr><td colspan="5">None</td></tr>
        @endforelse

        </tbody>
    </table>

    <table class="table table-bordered">
        <thead>
        <tr><th colspan="9">Orders positions</th></tr>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Recipient</th>
            <th>Category</th>
            <th>Dish</th>
            <th>Ingredients</th>
            <th>Weight (g)</th>
            <th>Price</th>
            <th>Count</th>
        </tr>
        </thead>
        <tbody>

        @forelse($user->orderCustomers as $order)
            @php($id = null)
            @foreach($order->orderItems as $item)
                <tr>
                    @if($id !== $order->id)
                    <td rowspan="{{ $order->orderItems->count() ?? 1 }}">{{ $order->id }}</td>
                    <td rowspan="{{ $order->orderItems->count() ?? 1 }}">{{ $user->name }}</td>
                    <td rowspan="{{ $order->orderItems->count() ?? 1 }}">{{ $order->recipient->name ?? $user->name }}</td>
                    @endif
                    <td>{{ $item->dish->category->name }}</td>
                    <td>{{ $item->dish->name }}</td>
                    <td>{{ $item->dish->ingredients }}</td>
                    <td>{{ $item->dish->weight }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->count }}</td>
                </tr>
                @php($id = $order->id)
            @endforeach
        @empty
            <tr><td colspan="9">None</td></tr>
        @endforelse

        </tbody>
    </table>
@endsection