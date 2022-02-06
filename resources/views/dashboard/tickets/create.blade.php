@extends('layouts.dashboard')

@section('content')
<div class="w-50">
    <h1>チケット作成</h1>

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

    <form method="POST" action="/dashboard/events/ticket" class="mb-5" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-inline mt-4 mb-4 row">
            <label for="ticket-name" class="col-2 d-flex justify-content-start">チケット名</label>
            <input type="text" name="name" id="ticket-name" class="form-control col-8">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="ticket-amount" class="col-2 d-flex justify-content-start align-self-start">金額</label>
            <input type="number" name="price" id="ticket-amount" class="form-control col-8">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="ticket-sheets" class="col-2 d-flex justify-content-start align-self-start">販売数</label>
            <input type="number" name="number_seats" id="ticket-sheets" class="form-control col-8">
        </div>
        <div class="form-inline mt-4 mb-4 row">
            <label for="event-period_from" class="col-2 d-flex justify-content-start">支払形式</label>
            <div class="form-check">
                <input type="checkbox" name="pay_m1" class="form-check-input" id="pay_m1" checked>
                <label class="form-check-label" for="pay_m1">クレジット</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="pay_m2" class="form-check-input" id="pay_m2">
                <label class="form-check-label" for="pay_m2">銀行振込</label>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="w-50 btn samazon-submit-button">作成する</button>
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