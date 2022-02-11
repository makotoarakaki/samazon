@extends('layouts.item')
<script src="https://kit.fontawesome.com/3723f06c66.js" crossorigin="anonymous"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
        <div class="d-flex justify-content-center">
            <!-- <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList"> -->
            <ol class="breadcrumb">
                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="#">
                        <span itemprop="name">入力</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <div class="breadcrumb-gray">
                    <li itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="#">
                            <span itemprop="name">確認</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>

                    <li itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="#">
                            <span itemprop="name">完了</span>
                        </a>
                        <meta itemprop="position" content="3" />
                    </li>
                </div>
            </ol>
        </div>

            @if (isset($error))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="get" name="form1" action="/item_login">
                @csrf
                <div class="d-flex justify-content-end">
                    <a href="javascript:form1.submit()">購入経験がある方はこちら＞＞</a>
                </div>
                <input type="hidden" name="event_id" value="{{ $event_id }}"> 
                <input type="hidden" name="product_name" value="{{ $product_name }}">
                <input type="hidden" name="price" value="{{ $price }}">
            </form>
            <br/>
            <hr/>

            <form method="POST" action="{{ route('items.register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="name1" type="text" class="form-control @error('name1') is-invalid @enderror samazon-login-input" name="name1" value="{{ old('name1') }}" required autocomplete="name1" autofocus placeholder="山本">
                        <input id="name2" type="text" class="form-control @error('name2') is-invalid @enderror samazon-login-input" name="name2" value="{{ old('name2') }}" required autocomplete="name2" autofocus placeholder="太郎">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kana" class="col-md-5 col-form-label text-md-left">ふりがな<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>
                    <div class="col-md-7">
                            <input id="kana1" type="text" class="form-control @error('kana1') is-invalid @enderror samazon-login-input" name="kana1" value="{{ old('kana1') }}" required autocomplete="kana1" autofocus placeholder="やまもと">
                            <input id="kana2" type="text" class="form-control @error('kana2') is-invalid @enderror samazon-login-input" name="kana2" value="{{ old('kana2') }}" required autocomplete="kana2" autofocus placeholder="たろう">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>ふりがなを入力してください</strong>
                            </span>
                            @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror samazon-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="naru@naru.com">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email-confirm" class="col-md-5 col-form-label text-md-left">メールアドレス確認</label>

                    <div class="col-md-7">
                        <input id="email-confirm" type="email" class="form-control samazon-login-input" name="email_confirmation" required autocomplete="new-email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">都道府県<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <select type="text" class="form-control" name="area">                          
                            @foreach(config('pref') as $key => $score)
                                <option value="{{ $score }}">{{ $score }}</option>
                            @endforeach</select>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>都道府県を選択してください</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">パスワード<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror samazon-login-input" name="password" required autocomplete="new-password" pattern="[a-zA-Z0-9._%+-]{8, 15}" placeholder="８桁以上で入力して下さい">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="event_id" value="{{ $event_id }}"> 
                <input type="hidden" name="product_name" value="{{ $product_name }}">
                <input type="hidden" name="price" value="{{ $price }}">

                <hr />
                <div class="d-flex justify-content-center">
                    <button type="submit" class="w-50 btn samazon-submit-button">登録して次へ（確認）</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection