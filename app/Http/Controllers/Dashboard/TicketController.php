<?php

namespace App\Http\Controllers\Dashboard;
 
use Illuminate\Http\Request;
use App\Ticket;
use App\Http\Controllers\Controller;
 
class TicketController extends Controller
{
    public function index(Request $request)
    {
        $event_id = $request->event_id;

        $tickets = Ticket::where('event_id',$event_id)->get();

        return view('dashboard.tickets.index', compact('tickets', 'event_id'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $event_id = $request->input('event_id');

        return view('dashboard.tickets.create', compact('event_id'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket();

        $ticket->name = $request->input('name');
        $ticket->price = $request->input('price');
        $ticket->number_seats = $request->input('number_seats');
        $ticket->tax_flg = $request->input('tax_flg');
        $pay_m = 0;
        if ($request->input('pay_m1') == 'on') {
            $pay_m++;
        }
        if ($request->input('pay_m2') == 'on') {
            $pay_m++;
        }
        $ticket->pay_method = $pay_m;

        $event_id = $request->input('event_id');
        $ticket->event_id = $event_id;

        $ticket->save();

        return redirect()->route('dashboard.tickets.index', compact('event_id'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('dashboard.tickets.edit', compact('ticket'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->name = $request->input('name');
        $ticket->price = $request->input('price');
        $ticket->number_seats = $request->input('number_seats');
        $ticket->tax_flg = $request->input('tax_flg');
        $pay_m = 0;
        if ($request->input('pay_m1') == 'on') {
            $pay_m++;
        }
        if ($request->input('pay_m2') == 'on') {
            $pay_m++;
        }
        $ticket->pay_method = $pay_m;

        $event_id = $request->input('event_id');
        $ticket->event_id = $event_id;

        $ticket->update();

        return redirect()->route('dashboard.tickets.index', compact('event_id'));
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ticket $ticket)
    {
        $ticket->delete();

        $event_id = $request->input('event_id');

        return redirect()->route('dashboard.tickets.index', compact('event_id'));
    }



}