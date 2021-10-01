@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <form method="POST" action="{{ route('admin.menus.store') }}">
        @csrf

        <div class="form-group">
            <label for="dish_id" class="col-form-label">{{ __('Dish') }}</label>
            <div class="input-group{{ $errors->has('dish_id') ? ' is-invalid' : '' }}">
                <input type="text" name="dish_id" id="dish_id" list="dish-options"
                       class="form-control{{ $errors->has('dish_id') ? ' is-invalid' : '' }}"
                       value="{{ old('dish_id') }}" required>
                <div class="input-group-append">
                    <a href="{{ route('admin.dishes.create') }}"
                       class="btn btn-outline-success">{{ __('Add dish') }}</a>
                </div>
                <datalist id="dish-options">
                    @foreach($dishes as $dish)
                        <option value="{{ $dish->id }}">{{ $dish->category->name.' - '.$dish->name }}</option>@endforeach
                </datalist>
            </div>
            @if($errors->has('dish_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('dish_id') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="price" class="col-form-label">{{ __('Price') }}</label>
            <input type="number" name="price" id="price"
                   class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                   value="{{ old('price') }}" min="1" step="1" required>
            @if($errors->has('price'))
                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="actual_at" class="col-form-label">{{ __('Actual date') }}</label>
            <input type="date" name="actual_at" id="actual_at"
                   class="form-control{{ $errors->has('actual_at') ? ' is-invalid' : '' }}"
                   value="{{ old('actual_at', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" step="1"
                   required>
            @if($errors->has('actual_at'))
                <span class="invalid-feedback"><strong>{{ $errors->first('actual_at') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>
@endsection