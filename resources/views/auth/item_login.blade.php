@extends('layouts.item')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h3 class="mt-3 mb-3">ログイン</h3>
            @if (isset($error))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                </div>
            @endif
            @if (session('warning'))
            <div class="alert alert-danger">
                {{ session('warning') }}
            </div>
            @endif

            <hr>
            <form method="POST" action="{{ route('item_login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror samazon-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>メールアドレスが正しくない可能性があります。</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror samazon-login-input" name="password" required autocomplete="current-password" placeholder="パスワード">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>パスワードが正しくない可能性があります。</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="mt-3 btn samazon-submit-button w-100">
                        ログイン
                    </button>

                    <a class="btn btn-link mt-3 d-flex justify-content-center samazon-login-text" href="{{ route('password.request') }}">
                        パスワードをお忘れの場合
                    </a>
                </div>
                <input type="hidden" name="event_id" value="{{ $event_id }}"> 
                <input type="hidden" name="product_name" value="{{ $product_name }}"> 
                <input type="hidden" name="price" value="{{ $price }}">
                <input type="hidden" name="pay_method" value="{{ $pay_method }}">
            </form>

            <hr>

            <div class="form-group">
                <a class="btn btn-link mt-3 d-flex justify-content-center samazon-login-text" href="{{ route('register') }}">
                    新規登録
                </a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection