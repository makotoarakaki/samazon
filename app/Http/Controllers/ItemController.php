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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $event = Event::find($id);
        $tickets = Ticket::where('event_id', $id)->get();

        $date = date_create($event->event_date);
        $event_date = date_format($date, 'Y年m月d日H時i分');

        return view('items.create', compact('event_date', 'event', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function input(Request $request)
    {
        $event_date = $request->input('event_date'); // 開催日
        $price = $request->input('ticket'); // 商品料金
        $product_name = $request->input('name'.$price); // 商品名

        if(Auth::user()) {  
            return redirect()->route('items.confirm', compact('event_date', 'product_name', 'price'));
        }
        return view('items.input', compact('event_date', 'price', 'product_name'));
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function confirm(Request $request)
    {
        $token = "";
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $token = $user->token;    
        }
  
         $pay_jp_secret = env('PAYJP_SECRET_KEY');
         \Payjp\Payjp::setApiKey($pay_jp_secret);
 
         $card = [];
         $count = 0;
  
         if ($token != "") {
             $result = \Payjp\Customer::retrieve($user->token)->cards->all(array("limit"=>1))->data[0];
             $count = \Payjp\Customer::retrieve($user->token)->cards->all()->count;
  
             $card = [
                 'brand' => $result["brand"],
                 'exp_month' => $result["exp_month"],
                 'exp_year' => $result["exp_year"],
                 'last4' => $result["last4"] 
             ];

            }

        $event_date = $request->input('event_date');
        $product_name = $request->input('product_name');
        $price = $request->input('price');
 
        return view('items.confirm', compact('card', 'count', 'event_date', 'product_name', 'price'));
     }

     public function token(Request $request)
     {
         $pay_jp_secret = env('PAYJP_SECRET_KEY');
         \Payjp\Payjp::setApiKey($pay_jp_secret);
  
         $user = User::find(Auth::user()->id);
         $customer = $user->token;

         if ($customer != "") {
             $cu = \Payjp\Customer::retrieve($customer);
             $delete_card = $cu->cards->retrieve($cu->cards->data[0]["id"]);
             $delete_card->delete();
             $cu->cards->create(array(
                 "card" => request('payjp-token')
             ));
         } else {
             $cu = \Payjp\Customer::create(array(
                 "card" => request('payjp-token')
             ));
             $user->token = $cu->id;
             $user->update();
         } 

         $event_date = $request->input('event_date');
         $product_name = $request->input('product_name');
         $price = $request->input('price');

         return redirect()->route('items.confirm', compact('event_date', 'product_name', 'price'));
    }
}
