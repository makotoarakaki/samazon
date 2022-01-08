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
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-event_date" class="col-2 d-flex justify-content-start">開催日時</label>
            <div class="input-group date" id="datePicker" data-target-input="nearest">                                                        
                <input type="datetime" name="event_date" required class="form-control form-control-sm datetimepicker-input" data-target="#datePicker"/>
                <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>        
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-period_from" class="col-2 d-flex justify-content-start">開催期間</label>
            <div class="input-group date" id="datePicker2" data-target-input="nearest">                                                        
                <input type="datetime" name="period_from" required class="form-control form-control-sm datetimepicker-input" data-target="#datePicker"/>
                <div class="input-group-append" data-target="#datePicker2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            &nbsp;〜&nbsp;
            <div class="input-group date" id="datePicker3" data-target-input="nearest">                                                        
                <input type="datetime" name="period_to" required class="form-control form-control-sm datetimepicker-input" data-target="#datePicker"/>
                <div class="input-group-append" data-target="#datePicker3" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>        
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-period_from" class="col-2 d-flex justify-content-start">支払形式</label>
            <div class="form-check">
                <input type="checkbox" name="number_sales" class="form-check-input" id="check1a" checked>
                <label class="form-check-label" for="check1a">クレジット</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="number_sales" class="form-check-input" id="check1b">
                <label class="form-check-label" for="check1b">銀行振込</label>
            </div>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-ntc_email1" class="col-2 d-flex justify-content-start">通知先</label>
            <input type="text" name="ntc_email1" id="event-ntc_email1" class="form-control col-8" placeholder="aaa@gmail.com">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-ntc_email1" class="col-2 d-flex justify-content-start">通知先2</label>
            <input type="text" name="ntc_email2" id="event-ntc_email2" class="form-control col-8">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-ntc_email1" class="col-2 d-flex justify-content-start">通知先3</label>
            <input type="text" name="ntc_email3" id="event-ntc_email3" class="form-control col-8">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-period_from" class="col-2 d-flex justify-content-start">分類</label>
            <div class="form-check">
                <input type="checkbox" name="after_mail_flg" class="form-check-input" id="check1a">
                <label class="form-check-label" for="check1a">後日メールで商品やメッセージを送る</label>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="w-25 btn samazon-submit-button">確認する</button>
        </div>
    </form>

    <div class="d-flex justify-content-end">
        <a href="/dashboard/events">イベント一覧に戻る</a>
    </div>
</div>

    <!-- datepicker -->
    <!-- Tempus Dominus Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/locale/ja.min.js" integrity="sha512-rElveAU5iG1CzHqi7KbG1T4DQIUCqhitISZ9nqJ2Z4TP0z4Aba64xYhwcBhHQMddRq27/OKbzEFZLOJarNStLg==" crossorigin="anonymous"></script>
    <!-- Moment.js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0/js/tempusdominus-bootstrap-4.min.js"></script>

<script type="text/javascript">
    $(function(){
        $('#event_date').datetimepicker({locale: 'ja', dayViewHeaderFormat: 'YYYY年M月' ,format: 'YYYY/MM/DD'});
    });

    $(function(){
        $('#period_from').datetimepicker({locale: 'ja', dayViewHeaderFormat: 'YYYY年M月' ,format: 'YYYY/MM/DD'});
    });

    $(function(){
        $('#period_to').datetimepicker({locale: 'ja', dayViewHeaderFormat: 'YYYY年M月' ,format: 'YYYY/MM/DD'});
    });

    $("#event-image").change(function() {
         if (this.files && this.files[0]) {
             let reader = new FileReader();
             reader.onload = function(e) {
                 $("#event-image-preview").attr("src", e.target.result);
             }
             reader.readAsDataURL(this.files[0]);
         }
     });
</script>
@endsection