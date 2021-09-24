@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
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
            <label for="image" class="col-form-label">{{ __('Image') }}</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" id="image"
                           class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}"
                           value="{{ old('image') }}" size="256000" accept=".jpg, .jpeg, .png, .webp" required>
                    <label class="custom-file-label" for="image">Choose image...</label>
                </div>
            </div>
            @if($errors->has('image'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('image') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>
@endsection