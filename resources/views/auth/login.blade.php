
@extends('form')

@section('form-content')
    <div class="card">
        <h4 class="card-title mb-4 mt-1">Login</h4>
        <article class="card-body mx-auto">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">E-Mail Address</label>
                    <input name="email" class="col-sm-8 form-control" type="email">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Password</label>
                    <input name="password" class="col-sm-8 form-control" type="password">
                </div>
                <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="checkbox">
                        <label> <input name="remember" type="checkbox">Remember Me</label>
                    </div> <!-- checkbox .// -->
                </div> <!-- form-group// -->
                <div class="row">
                    <div class="col-sm-4"></div>
                    <button type="submit" class="btn btn-primary btn-block col-sm-2"> Login  </button>
                    <div class="col-sm-6 text-left">
                        <div class="d-flex h-100">
                            <a class="small my-auto" href="#">Forgot your password?</a>
                        </div>
                    </div>
                </div> <!-- .row// -->
            </form>
        </article>
    </div>

    <link rel="stylesheet"  href="{{ URL::asset('css/login.css') }}">
@endsection
