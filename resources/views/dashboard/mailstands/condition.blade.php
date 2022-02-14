@extends('layouts.dashboard')

@section('content')
<div class="w-50">
    <h1>配信対象者設定</h1>

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

    <form method="POST" name="form1" action="/dashboard/mailstands" class="mb-5" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-inline mt-4 mb-4 row">
            <label for="ticket-tax" class="col-2 d-flex justify-content-start align-self-start">条件対象</label>
            <ul class="radios">
                <li>
                    <div class="input-group">
                        <input type="radio" class="js-check" name="user" id="user-1" value="1" onclick="formSwitch()" checked>
                        <label for="user-1">登録ユーザー</label>
                    </div>
                </li>
                <li>
                    <div class="input-group">
                        <input type="radio" class="js-check" name="user" id="user-2" value="2" onclick="formSwitch()">
                        <label for="user-2">イベント</label>
                    </div>
                    <br >
                    <div class="input-group">
                        <span>
                            <a id="link" href="/dashboard/mailstands/1" class="btn samazon-submit-button"><i class="fas fa-search"></i>検索</a>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
        @if($show === '1')
        <div class="table-responsive">
            <table class="table fixed-table mt-5">

                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">名前</th>
                        <th scope="col">メールアドレス</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($values as $val)
                    <tr>
                        <th scope="row"></td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="table-responsive">
            <table class="table fixed-table mt-5">

                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">イベント名</th>
                        <th scope="col">開催日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($values as $val)
                    <tr>
                        <th scope="row"></td>
                        <td>{{ $val->title }}</td>
                        <td>{{ $val->event_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        <div class="d-flex justify-content-end">
            <button type="submit" class="w-25 btn samazon-submit-button">条件設定</button>
        </div>
    </form>

    <div class="d-flex justify-content-end">
        <a href="/dashboard/mailstands/create">メール一登録に戻る</a>
    </div>
</div>

<script type="text/javascript">

    function formSwitch() {
        check = document.getElementsByClassName('js-check')
        if (check[0].checked) {
            let link = document.getElementById('link');
            let url = '/dashboard/mailstands/1';

            //href属性の値を書き換える
            link.setAttribute('href', url);

        } else if (check[1].checked) {
            let link = document.getElementById('link');
            let url = '/dashboard/mailstands/2';

            //href属性の値を書き換える
            link.setAttribute('href', url);
        }
    }
</script>

@endsection