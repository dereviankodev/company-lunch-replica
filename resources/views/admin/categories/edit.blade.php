@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   value="{{ old('name', $category->name) }}" required>
            @if($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label">{{ __('Image') }}</label>
            <div>
                @if(!is_null($category->img_path))
                    <img src="{{ asset($category->img_path) }}" alt="{{ $category->name }}"
                         width="765" height="70" class="img-fluid">
                @else
                    {{ __('No image') }}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label">{{ __('Change Image') }}</label>
            <div class="input-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                <div class="custom-file">
                    <input type="file" name="image" id="image"
                           class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}"
                           size="256000" accept=".jpg, .jpeg, .png, .webp">
                    <label class="custom-file-label" for="image">Choose image...</label>
                </div>
            </div>
            @if($errors->has('image'))
                <span class="invalid-feedback"><strong>{{ $errors->first('image') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
@endsection