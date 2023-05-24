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

        return view('mypage.index')
            ->with('participant', $participant);
    }

    public function self_checkin(Request $request)
    {
        if (isset($request->uuid)) {
            $uuid = $request->uuid;

            if ($request->confirm == 'true') {
                // 全体会
                if (
                    now()->between(env('CEREMONY1_ACCEPT_START'), env('CEREMONY1_ACCEPT_END')) ||
                    now()->between(env('CEREMONY2_ACCEPT_START'), env('CEREMONY2_ACCEPT_END'))
                ) {
                    $person = Participant::where('uuid', $uuid)->where('checkedin_at', null)->firstorfail();
                    $person->checkedin_at = now();
                    $person->checkin_type_ceremony = 'self';
                    $person->save();
                    Flash::success($person->name . "さんのチェックイン完了");
                }
                // 交歓会
                if (now()->between(env('RECEPTION_ACCEPT_START'), env('RECEPTION_ACCEPT_END'))) {
                    $person = Participant::where('uuid', $uuid)->where('reception_checkedin_at', null)->firstorfail();
                    $person->reception_checkedin_at = now();
                    $person->checkin_type_reception = 'self';
                    $person->save();
                    Flash::success($person->name . "さんのチェックイン完了");
                }
            }
            $participant = Participant::where('uuid', $request->uuid)->firstorfail();
            return view('mypage.self_checkin')->with('participant', $participant);
        } else {
            return back();
        }
    }
}
