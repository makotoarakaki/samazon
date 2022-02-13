@extends('layouts.dashboard')

@section('content')
<div class="w-50">
    <h1>メール登録</h1>

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
                        <label for="user-2">条件を設定する。</label>
                    </div>
                    <br >
                    <div class="input-group">
                        <span id="jyoken">
                            <a href="{{ route('dashboard.mailstands.condition') }}" class="btn samazon-submit-button">条件設定</a>
                        </span>
                    </div>
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
            <button type="submit" class="w-25 btn samazon-submit-button" onclic="window.onload()" >配信</button>
        </div>
    </form>

    <div class="d-flex justify-content-end">
        <a href="/dashboard/mailstands">メール一覧に戻る</a>
    </div>
</div>


<script type="text/javascript">

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