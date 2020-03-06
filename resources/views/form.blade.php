
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/css/form.css">
    @yield('form-head')
@endsection

@section('content')
<div
    class="form-wrapper {{ empty($yAlign) ? '' : 'align-items-center' }}"
>
    <div class="mx-auto">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('form-content')
    </div>
</div>
@endsection
