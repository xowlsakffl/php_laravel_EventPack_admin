@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
e['email_address']}}</div>
            </div>

            <div class="row">
                <div class="col-2">소유자 휴대폰</div>
                <div class="col-8">{{$site['phone_name']}}</div>
            </div>

            <div class="row">
                <div class="col-2">소유자 휴대폰</div>
                <div class="col-8">{{$site['phone_address']}}</div>
            </div>

            <div class="row">
                <div class="col-2">웹사이트 타이틀</div>
                <div class="col-8">{{$site['title']}}</div>
            </div>

            <div class="row">
                <div class="col-2">설명</div>
                <div class="col-8">{{$site['description']}}</div>
            </div>
        </div>
        @endforeach
@endsection