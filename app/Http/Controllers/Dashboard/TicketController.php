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
}