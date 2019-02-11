@extends('layouts.app')

@section('content')
<div class="container login-page">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">{{ __('Login') }}</div>

                <div class="card-body shadow-none p-3 mb-2  rounded login-form">
                    <form method="POST" action="{{ route('login') }}" class="col-6 offset-3" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email" class=" justify-content-center">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} text-center" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password" class=" ">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control  text-center {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row ">
                            <div class=" col ">
                                <div class="checkbox float-md-right">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="">
                                <button type="submit" class="btn btn-block btn-primary  ">
                                    {{ __('Login') }}
                                </button>
                                <div class="hr">

                                </div>
                                <a class="btn btn-link " href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
