<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Response;
use Laracasts\Flash\Flash;

class AdminCancelController extends AppBaseController
{
    /** @var ParticipantRepository $participantRepository*/

    /**
     * Display a listing of the Participant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if (isset($request['uuid'])) { // 削除リクエストの処理
            $uuid = $request['uuid'];
            $cat = $request['cat'];
            $cancel = Participant::where('uuid', $uuid)->firstorfail();
            if ($cat == 'ceremony_checkin') { // チェックインのキャンセル
                $cancel->checkedin_at = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんの全体会チェックイン処理を取り消しました");
                return back();
            } elseif ($cat == 'reception_checkin') { // チェックインのキャンセル
                $cancel->reception_checkedin_at = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんの交歓会チェックイン処理を取り消しました");
                return back();
            } elseif ($cat == 'absent_ceremony') { // 欠席手続きのキャンセル
                $cancel->absent_ceremony = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんの全体会欠席処理を取り消しました");
                return back();
            } elseif ($cat == 'absent_reception') { // 欠席手続きのキャンセル
                $cancel->absent_reception = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんの交歓会欠席処理を取り消しました");
                return back();
            }
        } else { // 何もリクエストがないとき
            $participants = Participant::where('checkedin_at', '<>', NULL)
                ->orwhere('reception_checkedin_at', '<>', NULL)
                ->orderby('id', 'asc')->get();

            // $participant->save();
            return view('admin_cancel.index')
                ->with('participants', $participants);
        }
    }
}
