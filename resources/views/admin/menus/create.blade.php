@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <form method="POST" action="{{ route('admin.menus.store') }}">
        @csrf

        <div class="form-group">
            <label for="dish_id" class="col-form-label">{{ __('Dish') }}</label>
            <input type="text" name="dish_id" id="dish_id" list="dish-options" class="form-control{{ $errors->has('dish_id') ? ' is-invalid' : '' }}"
                   value="{{ old('dish_id') }}" required>
            <datalist id="dish-options">
                @foreach($dishes as $dish)
                    <option value="{{ $dish->id }}">{{ $dish->category->name.' - '.$dish->name }}</option>
                @endforeach
            </datalist>
            @if($errors->has('dish_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('dish_id') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>
@endsection