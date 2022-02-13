<?php

namespace App\Http\Controllers\Dashboard;

use DateTime;
use App\MailStand;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailStandController extends Controller
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
            $total_count = MailStand::where('title', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->count();

            $mails = MailStand::where('title', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->sortable($sort_query)->paginate(15);
        } else {
            $keyword = "";
            $total_count = MailStand::count();
            $mails = MailStand::sortable($sort_query)->paginate(15);
        }

        $sort = [
            '古い順' => 'updated_at asc',
            '新しい順' => 'updated_at desc'
        ];

        return view('dashboard.mailstands.index', compact('mails', 'sort', 'sorted', 'total_count', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.mailstands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sendmail = new MailStand();

        $title = $request->input('title');
        $sendmail->title = $title;
        $comment = $request->input('comment');
        $sendmail->comment = $comment;
        if ($request->input('send') == '1') {
            $d = new DateTime();
            $sendmail->send_datetime = $d->modify('+9 hour')->format('Y-m-d H:i');
        } else {
            $d = new DateTime($request->input('date').' '.$request->input('time'));
            $sendmail->send_datetime = $d->format('Y-m-d H:i');
        }

        $sendmail->save(); // データ登録

        // 今すぐメール送信
        if ($request->input('send') == '1') {
            // 全ユーザー取得
            $users = User::all();

            // メール送信準備
            $sendmail = app()->make('App\Http\Controllers\SendMailController');

            foreach($users as $user) {
                $sendmail->send($user->email, $user->name, $title, $comment);
            }
        }

        return redirect()->route('dashboard.mailstands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MailStand  $mailStand
     * @return \Illuminate\Http\Response
     */
    public function show(MailStand $mailStand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MailStand  $mailStand
     * @return \Illuminate\Http\Response
     */
    public function edit(MailStand $mailStand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MailStand  $mailStand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailStand $mailStand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MailStand  $mailStand
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailStand $mailStand)
    {
        dd($mailStand);
        $mailStand->delete();

        return redirect()->route('dashboard.mailstands.index');
    }

    public function condition()
    {
        return view('dashboard.mailstands.conditions');
    }
}
