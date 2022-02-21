<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ItemLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/items/confirm';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        $event_id = $request->input('event_id');
        $product_name = $request->input('product_name');
        $price = $request->input('price');
        $pay_method = $request->input('pay_method'); // 支払い方法

        return view('auth.item_login', compact('event_id', 'product_name', 'price', 'pay_method'));
    }

    public function login(Request $request)
    {
        $event_id = $request->input('event_id');
        $product_name = $request->input('product_name');
        $price = $request->input('price');
        $pay_method = $request->input('pay_method'); // 支払い方法

        $this->validate($request,[
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);
           
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return redirect()->route('items.confirm', compact('event_id', 'product_name', 'price', 'pay_method'));
        }
        return redirect()->back();
    }
    

    public function loggedOut(Request $request)
    {
        return redirect('auth.item_login');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->deleted_flag) {
            Auth::logout();
            return redirect()->route('auth.item_login')->with('warning', '退会済みのアカウントです！');;
        }
    }
}
