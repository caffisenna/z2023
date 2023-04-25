<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Participant;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset(Auth::user()->is_pref)) {
            // 県連認証済みなら一覧にリダイレクト
            $participants = Participant::where('pref', Auth::user()->is_pref)->where('category', '<>', '任意参加者')->paginate(100);
            return view('pref_participants.index')->with('participants', $participants);
        } else if (isset(Auth::user()->is_admin)) {
            $participants = Participant::where('name', '')->get();
            // $participants = Participant::all();
            // return view('home')->with('participants', $participants);
            $prefs = array(
                '北海道', '青森', '岩手', '宮城', '秋田', '山形', '福島',
                '茨城', '栃木', '群馬', '埼玉', '千葉', '東京', '神奈川', '新潟', '富山',
                '石川', '福井', '山梨', '長野', '岐阜', '静岡', '愛知', '三重', '滋賀',
                '京都', '大阪', '兵庫', '奈良', '和歌山', '鳥取', '島根', '岡山', '広島',
                '山口', '徳島', '香川', '愛媛', '高知', '福岡', '佐賀', '長崎', '熊本',
                '大分', '宮崎', '鹿児島', '沖縄', '荻窪',
                '日本連盟',
            );

            // foreach ($prefs as $pref) {
            //     $count = Participant::where('pref', $pref)->where('seat_number', '<>', NULL)
            //         ->where('self_absent', NULL)
            //         ->count();
            //     $checked_in = Participant::where('pref', $pref)->where('checkedin_at', '<>', NULL)
            //         ->count();
            //     $arr = array();
            //     $arr['name'] = $pref;
            //     $arr['count'] = $count;
            //     $arr['checked_in'] = $checked_in;
            //     $participants[] = $arr;
            // }

            // 全体数
            // $count = Participant::where('seat_number', '<>', NULL)
            //     ->where('self_absent', NULL)
            //     ->count();
            // $checked_in = Participant::where('checkedin_at', '<>', NULL)
            //     ->count();
            // $participants[] = array('name' => 'トータル', 'count' => $count, 'checked_in' => $checked_in);

            return view('home')->with('participants', $participants);
        } else {
            // それ以外はhomeへ
            return view('home');
        }
    }
}
