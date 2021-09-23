@extends('layouts.admin')

@section('content')
    @include('admin._nav')

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   value="{{ old('name', $user->name) }}" required>
            @if($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
            <input type="text" name="email" id="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   value="{{ old('email', $user->email) }}" required>
            @if($errors->has('email'))
                <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="is_admin" class="col-form-label">{{ __('Admin') }}</label>
            <select name="is_admin" id="is_admin" class="form-control{{ $errors->has('is_admin') ? ' is_invalid' : '' }}">
                    <option value="1"{{ old('is_admin', $user->is_admin) ? ' selected' : '' }}>
                        {{ __('Yes') }}
                    </option>
                    <option value="0"{{ !old('is_admin', $user->is_admin) ? ' selected' : '' }}>
                        {{ __('No') }}
                    </option>
            </select>
            @if($errors->has('is_admin'))
                <span class="invalid-feedback"><strong>{{ $errors->first('is_admin') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
@endsection