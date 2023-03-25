<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Response;
use Laracasts\Flash\Flash;

class CancelController extends AppBaseController
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
            if ($cat == 'checkin') { // チェックインのキャンセル
                $cancel->checkedin_at = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんのチェックイン処理を取り消しました");
                return back();
            } elseif ($cat == 'absent') { // 欠席手続きのキャンセル
                $cancel->self_absent = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんの欠席処理(式典)を取り消しました");
                return back();
            } elseif ($cat == 'reception_absent') { // 欠席手続きのキャンセル
                $cancel->reception_self_absent = NULL;
                $cancel->save();
                Flash::success($cancel->name . "さんの欠席処理(レセプション)を取り消しました");
                return back();
            }
        } else { // 何もリクエストがないとき
            $participants = Participant::where('checkedin_at', '<>', NULL)
                ->orwhere('self_absent', '<>', NULL)->orderby('id', 'asc')->get();

            // $participant->save();
            return view('cancel.index')
                ->with('participants', $participants);
        }
    }
}
