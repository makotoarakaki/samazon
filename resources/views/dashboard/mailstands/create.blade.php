@extends('layouts.dashboard')

@section('content')
<div class="w-50">
    <h1>メール登録</h1>

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

    <hr>

    <form method="POST" action="/dashboard/mailstands" class="mb-5" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-inline mt-4 mb-4 row">
            <label for="ticket-tax" class="col-2 d-flex justify-content-start align-self-start">配信日時</label>
            <ul class="radios">
                <li>
                    <div class="input-group">
                        <input type="radio" class="js-check" name="user" id="user-1" value="1" onclick="formSwitch()" checked>
                        <label for="user-1">全てのユーザーに送信</label>
                    </div>
                </li>
                <li>
                    <div class="input-group">
                        <input type="radio" class="js-check" name="user" id="user-2" value="2" onclick="formSwitch()" >
                        <label for="user-2">条件を設定する</label>
                    </div>
                    <br >
                    <div class="input-group">
                        <span id="jyoken">
                            <a href="/dashboard/mailstands/condition" class="btn samazon-submit-button">条件設定</a>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
        @if(!empty($event))
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-title" class="col-2 d-flex justify-content-start">イベント</label>
            <span class="form-control">{{$event->title}}</span>
            <input type="hidden" name="event_id" value="{{$event->id}}">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="tickets" class="col-2 d-flex justify-content-start">チケット</label>
            @foreach($tickets as $ticket)
                <span class="form-control">{{$ticket->name}}</span>
                <input type="hidden" name="ticket_name[]" value="{{$ticket->name}}">
            @endforeach
        </div>
        @endif
        <div class="form-inline mt-4 mb-4 row">
            <label for="ticket-tax" class="col-2 d-flex justify-content-start align-self-start">配信日時</label>
            <ul class="radios">
                <li>
                <div class="input-group">
                    <input type="radio" name="send" id="send-1" value="1" checked>
                    <label for="send-1">今すぐ配信</label>
                </div>
                </li>
                <li>
                    <input type="radio" name="send" id="send-2" value="2"> 
                    <label for="send-2">
                        <div class="input-group date" id="datePicker" data-target-input="nearest">                                                        
                            <input type="datetime" name="date" class="form-control form-control-sm datetimepicker-input" data-target="#datePicker"/>
                            <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <div class="input-group date" id="timePicker" data-target-input="nearest">                                                        
                            <input type="datetime" name="time" class="form-control form-control-sm datetimepicker-input" data-target="#timePicker"/>
                            <div class="input-group-append" data-target="#timePicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                   </label>
                </li>
            </ul>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="mail-title" class="col-2 d-flex justify-content-start">タイトル</label>
            <input type="text" name="title" id="mail-title" class="form-control col-8" required>
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="mail-comment" class="col-2 d-flex justify-content-start align-self-start">メール本文</label>
            <textarea name="comment" id="mail-comment" class="form-control col-8" rows="10" required></textarea>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="w-25 btn samazon-submit-button loadbtn">配信</button>
        </div>
    </form>

    <div class="d-flex justify-content-end">
        <a href="/dashboard/mailstands">メール一覧に戻る</a>
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
        $('#timePicker').datetimepicker({llocale: 'ja', format: 'HH:mm'});
    });

    // 条件設定の処理
    var button = document.getElementById('jyoken');

    function formSwitch() {
            check = document.getElementsByClassName('js-check')
            if (check[0].checked) {
                button.style.display = "none";

            } else if (check[1].checked) {
                button.style.display = "block";

            } else {
                button.style.display = "none";
            }
        }
        window.addEventListener('load', formSwitch());

        function entryChange2(){
            if(document.getElementById('changeSelect')){
            id = document.getElementById('changeSelect').value;
        }
    }
</script>
@endsection