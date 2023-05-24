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

            $order = [
                '北海道', '青森', '岩手', '宮城', '秋田', '山形', '福島',
                '茨城', '栃木', '群馬', '埼玉', '千葉', '東京', '神奈川', '新潟', '富山',
                '石川', '福井', '山梨', '長野', '岐阜', '静岡', '愛知', '三重', '滋賀',
                '京都', '大阪', '兵庫', '奈良', '和歌山', '鳥取', '島根', '岡山', '広島',
                '山口', '徳島', '香川', '愛媛', '高知', '福岡', '佐賀', '長崎', '熊本',
                '大分', '宮崎', '鹿児島', '沖縄', '荻窪', '日本',
            ]; // 県連の順番でソートさせるための配列

            // カウント
            $participants = Participant::select(
                'pref',
                \DB::raw('SUM(CASE WHEN name IS NOT NULL THEN 1 ELSE 0 END) as ceremony_yes_count'),
                \DB::raw('SUM(CASE WHEN checkedin_at IS NOT NULL THEN 1 ELSE 0 END) as ceremony_checkedin_count'), // チェックイン済み
                \DB::raw('SUM(CASE WHEN reception = "参加する" THEN 1 ELSE 0 END) as reception_yes_count'),
                \DB::raw('SUM(CASE WHEN reception_checkedin_at IS NOT NULL THEN 1 ELSE 0 END) as reception_checkedin_count'), // チェックイン済み
            )
                ->groupby('pref')
                ->orderBy(\DB::raw('FIELD(pref, "' . implode('","', $order) . '")')) // 県連でソート
                ->get();

            return view('home')->with('participants', $participants);
        } else {
            // それ以外はhomeへ
            return view('home');
        }
    }
}
