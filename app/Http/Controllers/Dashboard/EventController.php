<?php

namespace App\Http\Controllers\Dashboard;

use App\Event;
use App\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_query = [];
        $sorted = "";

        if ($request->sort !== null) {
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
        }

        if ($request->keyword !== null) {
            $keyword = rtrim($request->keyword);
            $total_count = Event::where('title', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->count();
            $events = Event::where('title', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->sortable($sort_query)->paginate(15);
        } else {
            $keyword = "";
            $total_count = Event::count();
            $events = Event::sortable($sort_query)->paginate(15);
        }

        $sort = [
            '古い順' => 'updated_at asc',
            '新しい順' => 'updated_at desc'
        ];

        return view('dashboard.events.index', compact('events', 'sort', 'sorted', 'total_count', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $from_mail = config('app.from_mail');

        return view('dashboard.events.create', compact('from_mail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'comment' => 'required',
        ],
        [
            'title.required' => 'イベント名は必須です。',
            'comment.required' => 'イベント説明は必須です。',
        ]);

        $event = new Event();

        $event->title = $request->input('title');
        $event->comment = $request->input('comment');
        if ($request->file('image') !== null) {
            $image = $request->file('image')->store('public/events');
            $event->image = basename($image);
        } else {
            $event->image = '';
        }
        $event->category_id = $request->input('category_id');
        $event->event_date = $request->input('event_date');
        $event->event_time_from = $request->input('event_time_from');
        $event->event_time_to = $request->input('event_time_to');
        $event->venue = $request->input('venue');
        $event->administrator = $request->input('administrator');
        $event->ntc_email1 = $request->input('ntc_email1');
        $event->ntc_email2 = $request->input('ntc_email2');
        $event->ntc_email3 = $request->input('ntc_email3');

        $event->save();

        $event_new = Event::orderBy('created_at', 'desc')->first();
        $event_id = $event_new->id;

        // $ticket = app()->make('App\Http\Controllers\Dashboard\TicketController');
        // $ticket->index($event_id);
 
        return redirect()->route('dashboard.tickets.index', compact('event_id'));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ticket(Request $request)
    {
        $ticket = new Ticket();
        $ticket->id = $request->input('id');
        $pay_m = 0;
        if ($request->input('pay_m1') == 'on') {
            $pay_m++;
        }
        if ($request->input('pay_m2') == 'on') {
            $pay_m++;
        }
        $ticket->pay_method = $pay_m;


        return redirect()->route('show', $ticket->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        return view('dashboard.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'comment' => 'required',
        ],
        [
            'title.required' => 'イベント名は必須です。',
            'comment.required' => 'イベント説明は必須です。',
        ]);

        $event->title = $request->input('title');
        $event->comment = $request->input('comment');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/events');
            $event->image = basename($image);
        } else if(isset($event->image)) {
            // do nothing
        } else {
            $event->image = '';
        }
        $event->category_id = $request->input('category_id');
        $event->event_date = $request->input('event_date');
        $event->event_time_from = $request->input('event_time_from');
        $event->event_time_to = $request->input('event_time_to');
        $event->venue = $request->input('venue');
        $event->administrator = $request->input('administrator');
        $event->ntc_email1 = $request->input('ntc_email1');
        $event->ntc_email2 = $request->input('ntc_email2');
        $event->ntc_email3 = $request->input('ntc_email3');

        $event->update();

        // $event_new = Event::orderBy('created_at', 'desc')->first();
        // $event_id = $event_new->id;

        // $ticket = app()->make('App\Http\Controllers\Dashboard\TicketController');
        // $ticket->index($event_id);
 
        return redirect()->route('dashboard.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('dashboard.events.index');

    }
}
