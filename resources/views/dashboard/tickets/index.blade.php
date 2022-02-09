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

        <div class="d-flex justify-content-between w-75 mt-4">
            <a href="/dashboard/tickets/create?event_id={{$event_id}}" class="btn samazon-submit-button">+ 新規作成</a>
        </div>

        <div class="table-responsive">
            <table class="table fixed-table mt-5">

                <thead>
                    <tr>
                        <th scope="col">チケット名</th>
                        <th scope="col">金額</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->name }}</td>
                        <td>{{ $ticket->price }}</td>
                        <td>
                            <a href="/dashboard/tickets/{{ $ticket->id }}/edit" class="dashboard-edit-link">編集</a>
                        </td>
                        <td>
                            <a href="/dashboard/tickets/{{ $ticket->id }}" onclick="event.preventDefault(); document.getElementById('logout-form{{ $ticket->id }}').submit();" class="dashboard-delete-link">
                                削除
                            </a>

                            <form id="logout-form{{ $ticket->id }}" action="/dashboard/tickets/{{ $ticket->id }}?event_id={{$event_id}}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <a href="/dashboard/events/{{$event_id}}" class="btn samazon-submit-button">確認</a>
        </div>

    <div class="d-flex justify-content-end">
        <a href="/dashboard/events">イベント一覧に戻る</a>
    </div>
</div>

@endsection