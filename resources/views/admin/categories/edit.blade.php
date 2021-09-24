@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
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
            <label for="img_path" class="col-form-label">{{ __('Image') }}</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="img_path" id="img_path"
                           class="custom-file-input{{ $errors->has('img_path') ? ' is-invalid' : '' }}"
                           value="{{ old('img_path', $category->img_path) }}" size="256000" accept=".jpg, .jpeg, .png, .webp" required>
                    <label class="custom-file-label" for="image">Choose image...</label>
                </div>
            </div>
            @if($errors->has('img_path'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('img_path') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
@endsection