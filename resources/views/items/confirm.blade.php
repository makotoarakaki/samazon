@extends('layouts.item')
<script src="https://kit.fontawesome.com/3723f06c66.js" crossorigin="anonymous"></script>
@section('content')
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
                <li itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="#">
                            <span itemprop="name">確認</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                <div class="breadcrumb-gray">
                    <li itemprop="breadcrumb-gray" itemscope
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
                <div class="form-inline mt-4 mb-4 row samazon-border-comment">
                        {{$product_name}}&nbsp;：&nbsp;{{number_format($price)}}円（税込）
                </div>
                @if($pay_method === '1')              
                <div class="d-flex justify-content-center">
                    <div class="container w-50">
                        @if (!empty($card))
                            <h3>登録済みのクレジットカード</h3>

                            <hr>
                            <h4>{{ $card["brand"] }}</h4>
                            <p>有効期限: {{ $card["exp_year"] }}/{{ $card["exp_month"] }}</p>
                            <p>カード番号: ************{{ $card["last4"] }}</p>
                        @endif

                        <form action="/items/token" method="post">
                            @csrf
                            @if (empty($card))
                            <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ ENV('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="カードを登録する" data-submit-text="カードを登録する"></script>
                            @else
                            <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ ENV('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="カードを更新する" data-submit-text="カードを更新する"></script>
                            @endif
                            <input type="hidden" name="event_id" value="{{ $event_id }}"> 
                            <input type="hidden" name="product_name" value="{{ $product_name }}"> 
                            <input type="hidden" name="price" value="{{ $price }}">
                            <input type="hidden" name="pay_method" value="{{ $pay_method }}">
                        </form>
                    </div>
                </div>
                @endif

                <hr />
            <form method="POST" action="/items/store" class="mb-5" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event_id }}"> 
                <input type="hidden" name="product_name" value="{{ $product_name }}"> 
                <input type="hidden" name="price" value="{{ $price }}">
                <input type="hidden" name="pay_method" value="{{ $pay_method }}">
                @if (empty($card) && $pay_method !== '2')
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="w-50 btn btn-secondary" disabled>商品を購入する</button>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="w-50 btn samazon-submit-button loadbtn" >商品を購入する</button>
                    </div>
                @endif
            </form>
        </div>
        </div>
    </div>
</div>

@endsection