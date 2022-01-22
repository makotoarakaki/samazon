<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

class ItemRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

   /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
            'area' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function register(Request $request)
    {

        $event_date = $request->input('event_date');
        $product_name = $request->input('product_name');
        $price = $request->input('price');

        // パスワード桁数チェック
        if (strlen($request->input('password')) < 8) {
            $error = 'パスワードは８桁以上で入力して下さい。';
            return view('items.input', compact('product_name', 'price', 'error'));
        }
        // 登録ユーザーチェック
        $user = "";
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
        }
        if(!empty($user)) {
            $error = 'このメールアドレスは既に登録されています。「購入経験がある方はこちら」よりログインをお願いします。';
            return view('items.input', compact('product_name', 'price', 'error'));
        }

//        $validate = $this->validator($request->all())->validate();

        $user = new User;
       
        $user = $this->create($request->all());
        $this->guard()->login($user);

        return view('items.confirm', compact('event_date', 'product_name', 'price'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'area' => $data['area'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
