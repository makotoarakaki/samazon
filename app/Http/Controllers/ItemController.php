<?php

namespace App\Http\Controllers;

use App\Item;
use App\Event;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('遠輝');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $event = Event::find($id);
        $tickets = Ticket::where('event_id', $id)->get();

        return view('items.create', compact('event', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function input(Request $request)
    {
        $price = $request->input('ticket'); // 商品料金
        $name = $request->input('name'.$price); // 商品名

        $user = null;
        if(Auth::user()) {
            $user = User::find(Auth::user()->id);
        }
        
  
        $pay_jp_secret = env('PAYJP_SECRET_KEY');
        \Payjp\Payjp::setApiKey($pay_jp_secret);

        $card = [];
        $count = 0;
 
        if (!is_null($user) && $user->token != "") {
            $result = \Payjp\Customer::retrieve($user->token)->cards->all(array("limit"=>1))->data[0];
            $count = \Payjp\Customer::retrieve($user->token)->cards->all()->count;
 
            $card = [
                'brand' => $result["brand"],
                'exp_month' => $result["exp_month"],
                'exp_year' => $result["exp_year"],
                'last4' => $result["last4"] 
            ];
        }

        return view('items.input', compact('price', 'name', 'card', 'count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function register_card(Request $request)
    {
         $user = User::find(Auth::user()->id);
  
         $pay_jp_secret = env('PAYJP_SECRET_KEY');
         \Payjp\Payjp::setApiKey($pay_jp_secret);
 
         $card = [];
         $count = 0;
  
         if ($user->token != "") {
             $result = \Payjp\Customer::retrieve($user->token)->cards->all(array("limit"=>1))->data[0];
             $count = \Payjp\Customer::retrieve($user->token)->cards->all()->count;
  
             $card = [
                 'brand' => $result["brand"],
                 'exp_month' => $result["exp_month"],
                 'exp_year' => $result["exp_year"],
                 'last4' => $result["last4"] 
             ];
         }
 
         return view('users.register_card', compact('card', 'count'));
     }
}
