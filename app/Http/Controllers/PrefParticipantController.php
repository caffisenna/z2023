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
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationSend;

class PrefParticipantController extends AppBaseController
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
        $participants = Participant::where('pref', Auth::user()->is_pref)->where('category', '<>', '任意参加者')->paginate(100);

        return view('pref_participants.index')
            ->with('participants', $participants);
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

        return redirect(route('pref_participants.index'));
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
        // $participant = $this->participantRepository->find($id);
        $participant = Participant::where('pref',Auth::user()->is_pref)->where('id',$id)->first();

        if (empty($participant)) {
            Flash::error('閲覧権限がありません');

            return redirect(route('pref_participants.index'));
        }

        return view('pref_participants.show')->with('participant', $participant);
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
        $participant = Participant::where('pref',Auth::user()->is_pref)->where('id',$id)->first();

        if (empty($participant)) {
            Flash::error('編集権限がありません');

            return redirect(route('pref_participants.index'));
        }

        return view('pref_participants.edit')->with('participant', $participant);
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

            return redirect(route('pref_participants.index'));
        }

        $participant = $this->participantRepository->update($request->all(), $id);

        Flash::success("{$participant->name}さんの情報を更新しました");

        return redirect(route('pref_participants.index'));
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

            return redirect(route('pref_participants.index'));
        }

        $this->participantRepository->delete($id);

        Flash::success('削除しました');

        return redirect(route('pref_participants.index'));
    }

    public function sendmail(Request $request)
    {
        $input = $request->all();
        dd($input['uuid']);
        if (isset($input['uuid'])) { // UUID取得
            $participant = Participant::where('uuid', $input['uuid'])->first();
            $sendto = ['email' => $participant->email];
            Mail::to($sendto)->queue(new InvitationSend($participant));
        }

        $participants = Participant::where('deleted_at', NULL)
            ->paginate(100);

        return view('participants.sendmail')
            ->with('participants', $participants);
    }
}
