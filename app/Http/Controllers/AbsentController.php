<?php

namespace App\Http\Controllers;

use App\Repositories\ParticipantRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Participant;
use Illuminate\Http\Request;
use Response;
use Laracasts\Flash\Flash;

class AbsentController extends AppBaseController
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
            $participant->checkedin_at = now();

            $participant->save();
            return view('check_in.index')
                ->with('participant', $participant);
        } else {
            return back();
        }
    }

    public function input(Request $request)
    {
        // dd($request['uuid']); uuidが取れる
        if (isset($request->furigana)) {
            $participants = Participant::where('furigana', 'like', "$request->furigana%")
                ->where('checkedin_at', null)
                ->where('self_absent', null)
                ->get();

            return view('absent.input')->with('participants', $participants);
        }

        // 手入力チェックインの場合
        if (isset($request->uuid)) {
            $participant = Participant::where('uuid', $request->uuid)->firstorfail();
            $participant->self_absent = 'スタッフ入力';
            $participant->save();
            Flash::success($participant->name . "さんの欠席処理が完了しました");
            return view('absent.input')->with('participant', $participant);
        }

        return view('absent.input');
    }

    public function fever(Request $request)
    {
        // 発熱NGの場合
        // dd($request['uuid']); uuidが取れる
        if (isset($request->furigana)) {
            $participants = Participant::where('furigana', 'like', "$request->furigana%")
            ->orwhere('name', 'like', "%$request->furigana%")
                // ->where('checkedin_at', null)
                ->where('self_absent', null)
                ->get();

            return view('fever_absent.input')->with('participants', $participants);
        }

        // 手入力チェックインの場合
        if (isset($request->uuid)) {
            $participant = Participant::where('uuid', $request->uuid)->firstorfail();
            $participant->self_absent = '発熱NG';
            $participant->checkedin_at = NULL;
            $participant->save();
            Flash::success($participant->name . "さんの発熱欠席処理が完了しました");
            return view('fever_absent.input')->with('participant', $participant);
        }

        return view('fever_absent.input');
    }
}
