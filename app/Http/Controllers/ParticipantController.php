<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Repositories\ParticipantRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Participant;
use Illuminate\Http\Request;
use Flash;
use Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationSend;

class ParticipantController extends AppBaseController
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
        // $participants = $this->participantRepository->paginate(100);
        $participants = $this->participantRepository;

        return view('participants.index')
            ->with('participants', $participants);
    }

    public function search(Request $request)
    {
        if (isset($request->furigana)) {
            // 個別氏名をサーチ
            // $participants = Participant::where('furigana', 'like', "$request->furigana%")->where('checkedin_at', null)->paginate(100);
            $participants = Participant::where('furigana', 'like', "$request->furigana%")->orwhere('name', 'like', "%$request->furigana%")->paginate(100); // チェックイン済みも取得して表示する

            // foreachで回して、引率指導者の場合は同じ県連のBSとVSを引っかける
            // $participant->vs $participant->bs などに格納
            foreach ($participants as $value) {
                if ($value->category == "県連代表(4)") {
                    $value->vs = Participant::where('pref', $value->pref)->where('category', '県連代表(5)')->select('name')->first();
                    $value->bs = Participant::where('pref', $value->pref)->where('category', '県連代表(6)')->select('name')->first();
                }
            }

            // 結果を返す
            return view('participants.index')->with('participants', $participants);
        }

        if (isset($request->prefecture)) {
            // $participants = Participant::where('pref', "$request->prefecture")->where('checkedin_at', null)->paginate(100);
            $participants = Participant::where('pref', "$request->prefecture")->paginate(100); // チェックイン済みも取得して表示する
            return view('participants.index')->with('participants', $participants);
        }
    }

    /**
     * Show the form for creating a new Participant.
     *
     * @return Response
     */
    public function create()
    {
        return view('participants.create');
    }

    /**
     * Store a newly created Participant in storage.
     *
     * @param CreateParticipantRequest $request
     *
     * @return Response
     */
    public function store(CreateParticipantRequest $request)
    {
        $input = $request->all();

        // UUID生成
        $input['uuid'] = Uuid::uuid4();

        $participant = $this->participantRepository->create($input);

        Flash::success('参加者を登録しました');

        return redirect(route('participants.index'));
    }

    /**
     * Display the specified Participant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        return view('participants.show')->with('participant', $participant);
    }

    /**
     * Show the form for editing the specified Participant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        return view('participants.edit')->with('participant', $participant);
    }

    /**
     * Update the specified Participant in storage.
     *
     * @param int $id
     * @param UpdateParticipantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParticipantRequest $request)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        $participant = $this->participantRepository->update($request->all(), $id);

        Flash::success('更新しました');

        return redirect(route('participants.index'));
    }

    /**
     * Remove the specified Participant from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $participant = $this->participantRepository->find($id);

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        $this->participantRepository->delete($id);

        Flash::success('削除しました');

        return redirect(route('participants.index'));
    }

    public function checked_in(Request $request)
    {
        $participants = Participant::where('checkedin_at', '<>', NULL)
            ->paginate(100);

        return view('participants.checked_in')
            ->with('participants', $participants);
    }

    public function cancel_check_in(Request $request)
    {
        $uuid = $request['uuid'];
        $participant = Participant::where('uuid', $uuid)->firstorfail();

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        if (isset($participant)) {
            $participant->checkedin_at = NULL;
            $participant->save();
        }

        Flash::success($participant->name . 'のチェックインを取り消しました');

        return back();
    }

    public function absent_list(Request $request)
    {
        $participants = Participant::where('self_absent', '<>', NULL)
            ->paginate(100);

        return view('participants.absent_list')
            ->with('participants', $participants);
    }

    public function reception_absent_list(Request $request)
    {
        // レセプション欠席リスト
        $participants = Participant::where('reception_self_absent', '<>', NULL)
            ->paginate(100);

        return view('participants.reception_absent_list')
            ->with('participants', $participants);
    }

    public function cancel_absent(Request $request)
    {
        $uuid = $request['uuid'];
        $participant = Participant::where('uuid', $uuid)->firstorfail();

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        if (isset($participant)) {
            $participant->self_absent = NULL;
            $participant->save();
        }

        Flash::success($participant->name . 'の欠席入力を取り消しました');

        return back();
    }

    public function not_checked_in(Request $request)
    {
        $participants = Participant::where('checkedin_at', NULL)
            ->paginate(100);

        return view('participants.checked_in')
            ->with('participants', $participants);
    }

    public function sendmail(Request $request)
    {
        $input = $request->all();
        if (isset($input['uuid'])) { // UUID取得
            $participant = Participant::where('uuid', $input['uuid'])->first();
            if (isset($participant->email)) {
                $sendto = ['email' => $participant->email];
                // ここでカテゴリ & 参加タイプで切り分けないとだめ
                Mail::to($sendto)->queue(new InvitationSend($participant));
            }
            $participant->email_sent_at = now();
            $participant->save();
            Flash::success($participant->name . '様へデジタルパスを送信しました');
        }

        $participants = Participant::where('deleted_at', NULL)
            ->where('name', '<>', '')
            // ->paginate(100);
            ->get();

        return view('participants.sendmail')
            ->with('participants', $participants);
    }

    public function sendmail_pref(Request $request)
    // 県連ごとの送信
    {
        $input = $request->all();
        if (isset($input['pref'])) { // 県連取得
            $participants = Participant::where('pref', $input['pref'])->get();

            foreach ($participants as $participant) { // 個別にメール送信をループ
                // まず対象レコードがメアドを持っているか確認する!
                // 持っていなければスキップしないとシステムが死ぬ!!!
                if (isset($participant->email)) {
                    $sendto = ['email' => $participant->email];
                    Mail::to($sendto)->queue(new InvitationSend($participant));
                    $participant->email_sent_at = now();
                    $participant->save();
                }
            }
            Flash::success($input['pref'] . '連盟へデジタルパスを送信しました');
        }

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

        return view('participants.sendmail_pref')->with('prefs', $prefs);
    }


    public function fee_check(Request $request)
    {
        $input = $request->all();

        // uuidがあればDBから検索して入金確認日をチェック
        if (isset($input['uuid'])) {
            $participant = Participant::where('uuid', $input['uuid'])->first();
            $participant->fee_checked_at = now();
            $participant->save();
            Flash::success($participant->name . '様の入金チェックを行いました。');
        }

        $participants = Participant::where('reception_seat_number', '<>', null)
            ->where('fee_checked_at', null)
            ->get();

        return view('participants.fee_check')
            ->with('participants', $participants);
    }

    public function seat_number(Request $request)
    {
        $input = $request->all();
        if (isset($input['row'])) {
            $participants = Participant::where('seat_number', 'LIKE', $input['row'] . '%')
                ->where('self_absent',  NULL)
                ->orderBy('seat_number')
                ->get();
        } else {
            $participants = Participant::where('seat_number', '<>', null)
                ->where('self_absent',  NULL)
                ->orderBy('seat_number')
                ->get();
        }

        return view('participants.seat_number')
            ->with('participants', $participants);
    }

    public function reception_seat_number(Request $request)
    {
        $input = $request->all();
        if (isset($input['table'])) {
            $participants = Participant::where('reception_seat_number', 'LIKE', $input['table'] . '-%')
                ->where('reception_self_absent',  NULL)
                ->orderBy('reception_seat_number')
                ->get();
        } else {
            $participants = Participant::where('reception_seat_number', '<>', null)
                ->where('self_absent',  NULL)
                ->orderBy('reception_seat_number')
                ->get();
        }

        return view('participants.reception_seat_number')
            ->with('participants', $participants);
    }

    public function absent(Request $request)
    {
        $uuid = $request['uuid'];
        $q = $request['q'];
        $participant = Participant::where('uuid', $uuid)->firstorfail();

        if (empty($participant)) {
            Flash::error('Participant not found');

            return redirect(route('participants.index'));
        }

        if (isset($participant)) {
            if ($q == 'ceremony')
                $participant->self_absent = 'スタッフ入力';
            elseif ($q == 'reception') {
                $participant->reception_self_absent = 'スタッフ入力';
            }
            $participant->save();
        }

        Flash::success($participant->name . 'の欠席入力をしました');

        return redirect(route('participants.index'));
    }
}
