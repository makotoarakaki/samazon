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

    <form method="POST" action="/dashboard/events/{{ $event->id }}" class="mb-5" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-title" class="col-2 d-flex justify-content-start">イベント名</label>
            <input type="text" name="title" id="event-title" class="form-control col-8" value="{{ $event->title }}">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-description" class="col-2 d-flex justify-content-start align-self-start">イベント説明</label>
            <textarea name="comment" id="event-description" class="form-control col-8" rows="10">{{ $event->comment }}</textarea>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-image" class="col-2 d-flex justify-content-start">画像</label>
            @if ($event->image !== null)
                <img src="{{ asset('public/storage/events/'.$event->image) }}" id="event-image-preview" class="img-fluid w-25">
            @else
                <img src="#" id="event-image-preview">
            @endif
            <div class="d-flex flex-column ml-2">
                <label for="event-image" class="btn samazon-submit-button">画像を選択</label>
                <input type="file" name="image" id="event-image" onChange="handleImage(this.files)" style="display: none;">
            </div>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-category" class="col-2 d-flex justify-content-start">カテゴリ</label>
            <select name="category_id" class="form-control col-8" id="event-category">
                <option value="1" {{ $event->category_id == 1 ? 'selected' : '' }}>イベント</option>
                <option value="2" {{ $event->category_id == 2 ? 'selected' : '' }}>セミナー</option>
                <option value="3" {{ $event->category_id == 3 ? 'selected' : '' }}>講演会</option>
                <option value="4" {{ $event->category_id == 4 ? 'selected' : '' }}>ワークショップ</option>
            </select>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-event_date" class="col-2 d-flex justify-content-start">開催日</label>
            <div class="input-group date" id="datePicker" data-target-input="nearest">                                                        
                <input type="datetime" name="event_date" required class="form-control form-control-sm datetimepicker-input" data-target="#datePicker"  value="{{ $event->event_date }}"/>
                <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>        
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event_time_from" class="col-2 d-flex justify-content-start">開催時間</label>
            <div class="input-group date" id="timePicker_from" data-target-input="nearest">                                                        
                <input type="datetime" name="event_time_from" required class="form-control form-control-sm datetimepicker-input" data-target="#timePicker_from" value="{{ $event->event_time_from }}"/>
                <div class="input-group-append" data-target="#timePicker_from" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                </div>
            </div>
            &nbsp;〜&nbsp;
            <div class="input-group date" id="timePicker_to" data-target-input="nearest">                                                        
                <input type="datetime" name="event_time_to" required class="form-control form-control-sm datetimepicker-input" data-target="#timePicker_to" value="{{ $event->event_time_to }}"/>
                <div class="input-group-append" data-target="#timePicker_to" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                </div>
            </div>        
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-venue" class="col-2 d-flex justify-content-start align-self-start">イベント場所</label>
            <textarea name="venue" id="event-venue" class="form-control col-8" rows="10">{{ $event->venue }}</textarea>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-administrator" class="col-2 d-flex justify-content-start">講師名</label>
            <input type="text" name="administrator" id="event-administrator" class="form-control col-8" value="{{ $event->administrator }}">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-period_from" class="col-2 d-flex justify-content-start">支払形式</label>
            <div class="form-check">
                <input type="checkbox" name="pay_m1" class="form-check-input" id="pay_m1" {{ $event->pay_method == 1 || $event->pay_method == 3 ? 'checked' : '' }}>
                <label class="form-check-label" for="pay_m1">クレジット</label>
            </div>
            &nbsp;&nbsp;
            <div class="form-check">
                <input type="checkbox" name="pay_m2" class="form-check-input" id="pay_m2" {{ $event->pay_method == 2 || $event->pay_method == 3 ? 'checked' : '' }}>
                <label class="form-check-label" for="pay_m2">銀行振込</label>
            </div>
        </div>
        <!-- <div class="form-inline mt-4 mb-4 row">
            <label for="event-ntc_email1" class="col-2 d-flex justify-content-start">通知先</label>
            <input type="text" name="ntc_email1" id="event-ntc_email1" class="form-control col-8" value="{{ $event->ntc_email1 }}" placeholder="aaa@gmail.com">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-ntc_email1" class="col-2 d-flex justify-content-start">通知先2</label>
            <input type="text" name="ntc_email2" id="event-ntc_email2" class="form-control col-8" value="{{ $event->ntc_email2 }}">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-ntc_email1" class="col-2 d-flex justify-content-start">通知先3</label>
            <input type="text" name="ntc_email3" id="event-ntc_email3" class="form-control col-8" value="{{ $event->ntc_email3 }}">
        </div> -->
        <!-- <div class="form-inline mt-4 mb-4 row">
            <label for="event-period_from" class="col-2 d-flex justify-content-start">分類</label>
            <div class="form-check">
                <input type="checkbox" name="after_mail_flg" class="form-check-input" id="check1a">
                <label class="form-check-label" for="check1a">後日メールで商品やメッセージを送る</label>
            </div>
        </div> -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn samazon-submit-button">更新する</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/dashboard/tickets?event_id={{$event->id}}" class="btn samazon-submit-button">チケットを作成する</a>
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
        $('#datePicker').datetimepicker({locale: 'ja', dayViewHeaderFormat: 'YYYY年M月' ,format: 'YYYY/MM/DD'});
    });

    $(function(){
        $('#timePicker_from').datetimepicker({llocale: 'ja', format: 'HH:mm'});
    });

    $(function(){
        $('#timePicker_to').datetimepicker({locale: 'ja', format: 'HH:mm'});
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