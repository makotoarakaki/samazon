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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/item/input/token" method="post">
                @csrf
                <div class="form-group">
                    <label for="product-name">お名前</label>
                    <input type="text" name="name" id="product-name" class="form-control col-8" placeholder="木村 太郎">
                </div>
                <div class="form-group">
                    <label for="product-mail">メールアドレス</label>
                    <input type="mail" name="mail" id="product-mail" class="form-control col-8"  placeholder="example@gmail.com">
                </div>
                <div class="form-group">
                    <label for="product-pref">都道府県</label>
                    <select type="text" class="form-control  col-8" name="area">                          
                        @foreach(config('pref') as $key => $score)
                            <option value="{{ $score }}">{{ $score }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2 mb-2 row samazon-border-comment">
                    <label for="product">商品</label>
                    <br />
                    {{ $name }} : {{ $price }}円
                </div>
            
                <div class="form-group">
                    @if (!empty($card))
                    <h3>登録済みのクレジットカード</h3>

                    <hr>
                    <h4>{{ $card["brand"] }}</h4>
                    <p>有効期限: {{ $card["exp_year"] }}/{{ $card["exp_month"] }}</p>
                    <p>カード番号: ************{{ $card["last4"] }}</p>
                    @endif

                    @if (empty($card))
                        <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ ENV('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="カードを登録する" data-submit-text="カードを登録する"></script>
                    @else
                        <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ ENV('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="カードを更新する" data-submit-text="カードを更新する"></script>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="w-50 btn samazon-submit-button">次へ（確認）</button>
                </div>
            </form>


            <div class="d-flex justify-content-end">
                <a href="/dashboard/products">商品一覧に戻る</a>
            </div>
        </div>
    </div>
</div>

@endsection