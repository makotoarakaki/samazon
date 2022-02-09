@extends('layouts.dashboard')

@section('content')
<div class="w-75">

    <h1 class="h1-coler">{{ $event->title }}</h1>

    <table class="table mt-5">
        <tr><th scope="col" class="w-25">商品ID</th><td>{{ $event->id }}</td></tr>
        <tr><th scope="col" class="w-25">セミナー内容</th><td>{{ $event->comment }}</td></tr>
        <tr><th scope="col" class="w-25">募集ページ</th><td><a href="{{Request::root()}}/items/create/{{ $event->id }}" target="_blank">{{Request::root()}}/items/create/{{ $event->id }}</a></td></tr>
    </table>
</div>
@endsection