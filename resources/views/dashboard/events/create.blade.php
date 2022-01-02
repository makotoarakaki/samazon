@extends('layouts.dashboard')

@section('content')
<div class="w-50">
    <h1>イベント作成</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <hr>

    <form method="POST" action="/dashboard/events" class="mb-5" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-title" class="col-2 d-flex justify-content-start">イベント名</label>
            <input type="text" name="title" id="event-title" class="form-control col-8">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-description" class="col-2 d-flex justify-content-start align-self-start">イベント説明</label>
            <textarea name="comment" id="event-description" class="form-control col-8" rows="10"></textarea>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-image" class="col-2 d-flex justify-content-start">画像</label>
            <input type="file" name="image" id="event-image">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-category" class="col-2 d-flex justify-content-start">カテゴリ</label>
            <select name="category_id" class="form-control col-8" id="event-category">
                <option value="1">イベント</option>
                <option value="2">セミナー</option>
                <option value="3">講演会</option>
                <option value="4">ワークショップ</option>
            </select>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-price" class="col-2 d-flex justify-content-start">価格</label>
            <input type="number" name="price" id="event-price" class="form-control col-8">&nbsp;円
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-tax" class="col-2 d-flex justify-content-start">消費税</label>
            <label for="event-tax-in">税込価格</label>
            <input type="radio" name="tax" id="event-tax-in" class="samazon-check-box">
            &nbsp;
            <label for="event-tax-no">税別価格</label>
            <input type="radio" name="tax" id="event-tax-no" class="samazon-check-box">
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="w-25 btn samazon-submit-button">商品を登録</button>
        </div>
    </form>

    <div class="d-flex justify-content-end">
        <a href="/dashboard/products">商品一覧に戻る</a>
    </div>
</div>

<script type="text/javascript">
     $("#product-image").change(function() {
         if (this.files && this.files[0]) {
             let reader = new FileReader();
             reader.onload = function(e) {
                 $("#product-image-preview").attr("src", e.target.result);
             }
             reader.readAsDataURL(this.files[0]);
         }
     });
</script>
@endsection