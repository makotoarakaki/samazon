<?php

namespace App\Http\Controllers\Api;
 
use Illuminate\Http\Request;
use App\Ticket;
use App\Http\Controllers\Controller;
 
class TicketController extends Controller
{
    public function index()
    {
        // $tickets = Ticket::wehre('event_id', $event_id)->get();
        // dd($event_id, $tickets);
        return view('dashboard.tickets.index', compact('tickets', 'event_id'));
    }
}