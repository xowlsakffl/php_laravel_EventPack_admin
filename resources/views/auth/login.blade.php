@extends('layouts.app')

@section('content')
<div class="login_page">
    <div class="login_box">
        <h3>로그인</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input_control">
                <label for="id">아이디</label>
                <div>
                    <input id="uid" type="uid" @error('uid') is-invalid @enderror name="uid" value="{{ old('uid') }}" required autocomplete="uid" autofocus>
                    @error('uid')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="input_control">
                <label for="password">비밀번호</label>
                <div>
                    <input id="password" type="password" @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
                    @error('password')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <div>
                    <div>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label for="remember">
                            아이디 기억하기
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <button type="submit">
                        로그인
                    </button>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            비밀번호 찾기
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
