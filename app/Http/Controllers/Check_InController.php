<?php

namespace App\Http\Controllers;

use App\Repositories\ParticipantRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Participant;
use Illuminate\Http\Request;
use Response;
use Laracasts\Flash\Flash;

class Check_InController extends AppBaseController
{
    /** @var ParticipantRepository $participantRepository*/
    private $participantRepository;

    public function __construct(ParticipantRepository $participantRepo)
    {
        $this->participantRepository = $participantRepo;
    }

    /**
     * Display a listing of the Participant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (isset($request->id)) {
            // カメラスキャンでQR読み取った時 (id に uuidが入る)
            $participant = Participant::where('uuid', $request->id)->firstorfail();
            $participant->checkedin_at = now();

            // 本人、もしくは引率指導者のチェックイン
            $participant->save();
            return view('check_in.index')
                ->with('participant', $participant);
        } else {
            return back();
        }
    }

    public function input(Request $request)
    {
        if (isset($request->furigana)) {
            $participants = Participant::where('furigana', 'like', "$request->furigana%")
                ->orwhere('name', 'like', "%$request->furigana%")
                ->where('checkedin_at', null)->get();

            return view('check_in.input')->with('participants', $participants);
        }

        // 手入力チェックインの場合
        if (isset($request->uuid)) {
            $participant = Participant::where('uuid', $request->uuid)->firstorfail();
            $participant->checkedin_at = now();
            $participant->save();

            Flash::success($participant->name . "さんのチェックイン完了");
            // return view('check_in.input')->with('participant', $participant);
            return view('check_in.index')
                ->with('participant', $participant);
        }

        return view('check_in.input');
        // ->with('participant', $participant);
    }

    public function self_check_in(Request $request)
    {
        $uuid = $request['checkin_id'];

        // 対象取得(未チェックインを抽出)
        $person = Participant::where('uuid', $uuid)->where('checkedin_at', null)->firstorfail();
        $person->checkedin_at = now();  // 指導者
        $person->save();

        Flash::success($person->name . 'さんのチェックイン処理をしました');
        return back();
    }

    public function status()
    {
        // チェックインのステータス
        // $prefs = array(
        //     '北海道', '青森', '岩手', '宮城', '秋田', '山形', '福島',
        //     '茨城', '栃木', '群馬', '埼玉', '千葉', '東京', '神奈川', '新潟', '富山',
        //     '石川', '福井', '山梨', '長野', '岐阜', '静岡', '愛知', '三重', '滋賀',
        //     '京都', '大阪', '兵庫', '奈良', '和歌山', '鳥取', '島根', '岡山', '広島',
        //     '山口', '徳島', '香川', '愛媛', '高知', '福岡', '佐賀', '長崎', '熊本',
        //     '大分', '宮崎', '鹿児島', '沖縄', '荻窪','日本連盟',
        // );

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

        $participants = Participant::where('name', '')->get();
        $order = [
                '北海道', '青森', '岩手', '宮城', '秋田', '山形', '福島',
                '茨城', '栃木', '群馬', '埼玉', '千葉', '東京', '神奈川', '新潟', '富山',
                '石川', '福井', '山梨', '長野', '岐阜', '静岡', '愛知', '三重', '滋賀',
                '京都', '大阪', '兵庫', '奈良', '和歌山', '鳥取', '島根', '岡山', '広島',
                '山口', '徳島', '香川', '愛媛', '高知', '福岡', '佐賀', '長崎', '熊本',
                '大分', '宮崎', '鹿児島', '沖縄', '荻窪', '日本', '日本連盟',
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

        return view('status')->with('participants', $participants);
    }
}
