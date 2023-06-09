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
            // ここで時刻分岐
            if (
                // 全体会チェックイン
                // テストで実際の時刻を入れる時は env('')ではなく '2023-05-24 12:34:00'の形式で入れる事
                now()->between(env('CEREMONY1_ACCEPT_START'), env('CEREMONY1_ACCEPT_END')) ||
                now()->between(env('CEREMONY2_ACCEPT_START'), env('CEREMONY2_ACCEPT_END'))
            ) {
                $participant->checkedin_at = now();
            }
            if (now()->between(env('RECEPTION_ACCEPT_START'), env('RECEPTION_ACCEPT_END'))) {
                // 交歓会チェックイン
                $participant->reception_checkedin_at = now();
            }

            // データ保存して前画面へリダイレクト
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
            $uuid = $request->uuid;
            if (
                now()->between(env('CEREMONY1_ACCEPT_START'), env('CEREMONY1_ACCEPT_END')) ||
                now()->between(env('CEREMONY2_ACCEPT_START'), env('CEREMONY2_ACCEPT_END'))
            ) {
                $participant = Participant::where('uuid', $uuid)->where('checkedin_at', null)->firstorfail();
                $participant->checkedin_at = now();
                $participant->checkin_type_ceremony = 'self';
                $participant->save();
                Flash::success($participant->name . "さんのチェックイン完了");
            }
            // 交歓会
            if (now()->between(env('RECEPTION_ACCEPT_START'), env('RECEPTION_ACCEPT_END'))) {
                $participant = Participant::where('uuid', $uuid)->where('reception_checkedin_at', null)->firstorfail();
                $participant->reception_checkedin_at = now();
                $participant->checkin_type_reception = 'self';
                $participant->save();
                Flash::success($participant->name . "さんのチェックイン完了");
            }

            Flash::success($participant->name . "さんのチェックイン完了");

            return view('check_in.index')
                ->with('participant', $participant);
        }

        return view('check_in.input');
        // ->with('participant', $participant);
    }

    public function self_check_in(Request $request)
    {
        $uuid = $request['checkin_id'];

        if (now()->between(env('CEREMONY1_ACCEPT_START'), env('CEREMONY2_ACCEPT_START'))) {
            dd('true');
        } else {
            dd('false');
        }

        if ((env('CEREMONY1_ACCEPT_START') < now() && env('CEREMONY1_ACCEPT_END') > now()) ||
            (env('CEREMONY2_ACCEPT_START') < now() && env('CEREMONY2_ACCEPT_END') > now())
        ) {
            $person = Participant::where('uuid', $uuid)->where('checkedin_at', null)->firstorfail();
            $person->checkedin_at = now();
            $person->checkin_type_ceremony = 'self';
        } elseif ((env('RECEPTION_ACCEPT_START') < now() && env('RECEPTION_ACCEPT_END') > now())) {
            $person = Participant::where('uuid', $uuid)->where('reception_checkedin_at', null)->firstorfail();
            $person->reception_checkedin_at = now();
            $person->checkin_type_reception = 'self';
        }

        // 保存
        $person->save();

        Flash::success($person->name . 'さんのチェックイン処理をしました');
        return back();
    }

    public function status()
    {
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
