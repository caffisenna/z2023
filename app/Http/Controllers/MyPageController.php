<?php

namespace App\Http\Controllers;

use App\Repositories\ParticipantRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Participant;
use Illuminate\Http\Request;
use Response;
use Flash;

class MyPageController extends AppBaseController
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
            $participant = Participant::where('uuid', $request->id)->firstorfail();
        }

        // 引率スカウトを引っ張る
        if ($participant->category == "県連代表(4)") {
            $participant->vs = Participant::where('pref', $participant->pref)->where('category', '県連代表(5)')->select('name', 'uuid', 'seat_number', 'self_absent', 'checkedin_at')->first();
            $participant->bs = Participant::where('pref', $participant->pref)->where('category', '県連代表(6)')->select('name', 'uuid', 'seat_number', 'self_absent', 'checkedin_at')->first();
        }

        return view('mypage.index')
            ->with('participant', $participant);
    }

    public function self_absent(Request $request)
    {
        // $request['absent'] requestでUUIDが入ってくる
        $uuid = $request['absent'];
        $scout = Participant::where('uuid', $uuid)->firstorfail();
        if ($request['q'] == 'reception') {
            $scout->reception_self_absent = '自己入力';
        } else {
            $scout->self_absent = '自己入力';
        }
        $scout->save();

        Flash::success($scout->name . 'さんの欠席処理をしました');

        return back();
    }
}
