
@extends('form', [ 'yAlign' => false ])

@section('form-content')
    <div>
        <div class="form-head">{{ __('user-edit.user') }}</div>

        <form method="post" action="{{ $path }}">
            @csrf
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{{ __('user-edit.name') }}</label>
                <input
                    required
                    name="name"
                    class="col-sm-8 form-control"
                    placeholder="Enter name"
                    value="{{$user->name}}"
                >
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">
                    {{ __('user-edit.email') }}
                </label>
                <input
                    required
                    type="email"
                    name="email"
                    class="col-sm-8 form-control"
                    placeholder="Enter email"
                    value="{{$user->email}}"
                >
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">
                    {{ __('user-edit.password') }}
                </label>
                <input
                    type="password"
                    name="password"
                    class="col-sm-8 form-control"
                    placeholder="Enter password"
                >
            </div>

            <button class="btn btn-primary" type="submit">
                {{ __('user-edit.send') }}
            </button>
        </form>
    </div>
@endsection
