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

            // ここで引率するスカウトも同時チェックインする
            // 全然途中
            if ($participant->category == '県連代表(4)') { // 引率指導者かチェック
                $vs = Participant::where('pref', $participant->pref)->where('category', '県連代表(5)')
                ->where('name','<>', NULL)->first();
                $vs->checkedin_at = now(); // VSの打刻
                $vs->save(); // DB保存
                $bs = Participant::where('pref', $participant->pref)->where('category', '県連代表(6)')
                ->where('name','<>', NULL)->first();
                $bs->checkedin_at = now(); // BSの打刻
                $bs->save(); // DB保存
            }

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

            // 引率スカウトの取得
            foreach ($participants as $value) {
                if ($value->category == "県連代表(4)") {
                    $value->vs = Participant::where('pref', $value->pref)->where('category', '県連代表(5)')->select('name')->first();
                    $value->bs = Participant::where('pref', $value->pref)->where('category', '県連代表(6)')->select('name')->first();
                }
            }
            return view('check_in.input')->with('participants', $participants);
        }

        // 手入力チェックインの場合
        if (isset($request->uuid)) {
            $participant = Participant::where('uuid', $request->uuid)->firstorfail();
            $participant->checkedin_at = now();
            $participant->save();

            // 引率スカウトの取得
            if ($participant->category == "県連代表(4)") {
                $vs = Participant::where('pref', $participant->pref)->where('category', '県連代表(5)')->select('id', 'name')->first();
                $bs = Participant::where('pref', $participant->pref)->where('category', '県連代表(6)')->select('id', 'name')->first();

                // 打刻
                if (isset($vs)) {
                    $vs->checkedin_at = $participant->checkedin_at;
                    $vs->save();
                }

                if (isset($bs)) {
                    $bs->checkedin_at = $participant->checkedin_at;
                    $bs->save();
                }
            }

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

        // 引率スカウトの処理
        if ($person->category == "県連代表(4)") {
            $vs = Participant::where('pref', $person->pref)->where('category', '県連代表(5)')->first();
            $bs = Participant::where('pref', $person->pref)->where('category', '県連代表(6)')->first();

            // チェックイン処理
            if (empty($vs->self_absent)) {  // 欠席入力があればチェックインの打刻しない
                $vs->checkedin_at = now();  // VS
                $vs->save();
            }

            if (empty($bs->self_absent)) {  // 欠席入力があればチェックインの打刻しない
                $bs->checkedin_at = now();  // BS
                $bs->save();
            }
        }

        Flash::success($person->name . 'さんのチェックイン処理をしました');
        return back();
    }

    public function receipt(Request $request)
    {
        $uuid = $request['uuid'];
        $q = $request['q'];

        // 対象取得(未チェックインを抽出)
        $person = Participant::where('uuid', $uuid)->firstorfail();
        if ($q == 'gift') {
            $person->gift_receipt = now();
            Flash::success($person->name . 'さんの記念品お渡しが完了しました');
        } elseif ($q == 'cloak') {
            $person->cloak_receipt = now();
            Flash::success($person->name . 'さんのお預かり品返却が完了しました');
        }
        $person->save();

        // 引率スカウトの処理
        // if ($person->category == "県連代表(4)") {
        //     $vs = Participant::where('pref', $person->pref)->where('category', '県連代表(5)')->first();
        //     $bs = Participant::where('pref', $person->pref)->where('category', '県連代表(6)')->first();

        //     // チェックイン処理
        //     if (empty($vs->self_absent)) {  // 欠席入力があればチェックインの打刻しない
        //         $vs->checkedin_at = now();  // VS
        //         $vs->save();
        //     }

        //     if (empty($bs->self_absent)) {  // 欠席入力があればチェックインの打刻しない
        //         $bs->checkedin_at = now();  // BS
        //         $bs->save();
        //     }
        // }

        return back();
    }

    public function status()
    {
        // チェックインのステータス
        $prefs = array(
            '北海道', '青森', '岩手', '宮城', '秋田', '山形', '福島',
            '茨城', '栃木', '群馬', '埼玉', '千葉', '東京', '神奈川', '新潟', '富山',
            '石川', '福井', '山梨', '長野', '岐阜', '静岡', '愛知', '三重', '滋賀',
            '京都', '大阪', '兵庫', '奈良', '和歌山', '鳥取', '島根', '岡山', '広島',
            '山口', '徳島', '香川', '愛媛', '高知', '福岡', '佐賀', '長崎', '熊本',
            '大分', '宮崎', '鹿児島', '沖縄', '荻窪',
            '行政（国）',
            '行政（市）',
            '会場関係者',
            '①ボーイスカウト振興国会議員連盟',
            '②１００周年募金',
            '④B-Pフェロー',
            '⑤資金醸成団体',
            '表彰者',
            '⑥宗教関係代表者会議代表者',
            '⑦日本連盟名誉役員',
            '⑧日本連盟評議員会',
            '⑨日本連盟理事会',
            '⑩日本連盟監事',
            '⑩名誉会議',
            '⑩教育顧問会議',
            '⑩アンバサダー',
            '⑪県連盟連盟長',
            '新チャレンジ章協力企業',
            '⑫企業',
            '⑫関係団体（外部）',
            '⑬関係団体（内部）',
            'レセプション協力',
            '日本連盟',
        );

        foreach ($prefs as $pref) {
            $count = Participant::where('pref', $pref)->where('seat_number', '<>', NULL)
                ->where('self_absent', NULL)
                ->count();
            $checked_in = Participant::where('pref', $pref)->where('checkedin_at', '<>', NULL)
                ->count();
            $arr = array();
            $arr['name'] = $pref;
            $arr['count'] = $count;
            $arr['checked_in'] = $checked_in;
            $participants[] = $arr;
        }

        // 全体数
        $count = Participant::where('seat_number', '<>', NULL)
            ->where('self_absent', NULL)
            ->count();
        $checked_in = Participant::where('checkedin_at', '<>', NULL)
            ->count();
        $participants[] = array('name' => 'トータル', 'count' => $count, 'checked_in' => $checked_in);

        return view('status')->with('participants', $participants);
    }
}
