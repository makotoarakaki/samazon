@extends('layouts.dashboard')

@section('content')
<div class="w-75">

    <h1 class="h1-coler">{{ $event->title }}</h1>

    <table class="table mt-5">
        <tr><th scope="col" class="table-info w-25">商品ID</th><td>{{ $event->id }}</td></tr>
        <tr><th scope="col" class="table-info w-25">セミナー内容</th><td>{{ $event->comment }}</td></tr>
        <tr><th scope="col" class="table-info w-25">募集ページ</th><td><a href="{{Request::root()}}/items/create/{{ $event->id }}" target="_blank">{{Request::root()}}/items/create/{{ $event->id }}</a></td></tr>
        <tr><th scope="col" class="table-info w-25">日時</th><td>{{ $edate['event_date'] }}
        <br>
            {{$edate['etime_from']}}〜{{$edate['etime_to']}}
            </td>
        </tr>
        <tr><th scope="col" class="table-info w-25">開催場所</th><td>{{ $event->venue }}</td></tr>
        <tr><th scope="col" class="table-info w-25">講師</th><td>{{ $event->administrator }}</td></tr>
    </table>
</div>
@endsection