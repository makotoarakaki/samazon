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
            <li itemprop="breadcrumb-gray" itemscope
                itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="#">
                    <span itemprop="name">完了</span>
                </a>
                <meta itemprop="position" content="3" />
            </li>
        </ol>
    </div>
    <div class="row justify-content-center">
        <h3 class="text-center">お申し込みありがとうございます！</h3>

        <p class="text-center">
            ただいま、メールアドレス宛に、お申し込み内容のメールをお送りしました。
        </p>

        <div class="text-center">
            <a href="/" class="btn samazon-submit-button w-100 text-white">トップページへ</a>
        </div>
    </div>
    </div>
</div>
@endsection