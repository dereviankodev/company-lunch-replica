@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <form method="POST" action="{{ route('admin.dishes.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   value="{{ old('name') }}" required>
            @if($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="ingredients" class="col-form-label">{{ __('Ingredients (Comma separated)') }}</label>
            <input type="text" name="ingredients" id="ingredients" class="form-control{{ $errors->has('ingredients') ? ' is-invalid' : '' }}"
                   value="{{ old('ingredients') }}">
            @if($errors->has('ingredients'))
                <span class="invalid-feedback"><strong>{{ $errors->first('ingredients') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="weight" class="col-form-label">{{ __('Weight (g)') }}</label>
            <input type="number" name="weight" id="weight" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}"
                   value="{{ old('weight') }}" min="1" step="1" required>
            @if($errors->has('weight'))
                <span class="invalid-feedback"><strong>{{ $errors->first('weight') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="category_id" class="col-form-label">{{ __('Category') }}</label>
            <div class="input-group">
                <select name="category_id" id="category_id" class="custom-select{{ $errors->has('category_id') ? ' is-invalid' : '' }}" required>
                    <option value="" selected disabled>Choose...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"{{ $category->id == old('category_id') ? ' selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach;
                </select>
                <div class="input-group-append">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-success">{{ __('Add category') }}</a>
                </div>
            </div>
            @if($errors->has('category_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('category_id') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>
@endsection