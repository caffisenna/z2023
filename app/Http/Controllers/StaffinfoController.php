<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffinfoRequest;
use App\Http\Requests\UpdateStaffinfoRequest;
use App\Repositories\StaffinfoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use App\Models\Staffinfo;

class StaffinfoController extends AppBaseController
{
    /** @var StaffinfoRepository $staffinfoRepository*/
    private $staffinfoRepository;

    public function __construct(StaffinfoRepository $staffinfoRepo)
    {
        $this->staffinfoRepository = $staffinfoRepo;
    }

    /**
     * Display a listing of the Staffinfo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $staffinfo = Staffinfo::where('user_id', Auth::user()->id)->first();

        if (isset($staffinfo)) {
            return view('staffinfos.index')
                ->with('staffinfo', $staffinfo);
        } else {
            return view('staffinfos.index');
        }
    }

    /**
     * Show the form for creating a new Staffinfo.
     *
     * @return Response
     */
    public function create()
    {
        return view('staffinfos.create');
    }

    /**
     * Store a newly created Staffinfo in storage.
     *
     * @param CreateStaffinfoRequest $request
     *
     * @return Response
     */
    public function store(CreateStaffinfoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $staffinfo = $this->staffinfoRepository->create($input);

        Flash::success('スタッフ情報を登録しました');

        return redirect(route('staffinfos.index'));
    }

    /**
     * Display the specified Staffinfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staffinfo = $this->staffinfoRepository->find($id);

        if ($staffinfo->user_id <> Auth::user()->id) {
            Flash::error('閲覧権限がありません');
            return redirect(route('staffinfos.index'));
        }

        if (empty($staffinfo)) {
            Flash::error('スタッフ情報が見つかりません');

            return redirect(route('staffinfos.index'));
        }

        return view('staffinfos.show')->with('staffinfo', $staffinfo);
    }

    /**
     * Show the form for editing the specified Staffinfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $staffinfo = $this->staffinfoRepository->find($id);
        if ($staffinfo->user_id <> Auth::user()->id) {
            Flash::error('閲覧権限がありません');
            return redirect(route('staffinfos.index'));
        }

        if (empty($staffinfo)) {
            Flash::error('スタッフ情報が見つかりません');

            return redirect(route('staffinfos.index'));
        }

        return view('staffinfos.edit')->with('staffinfo', $staffinfo);
    }

    /**
     * Update the specified Staffinfo in storage.
     *
     * @param int $id
     * @param UpdateStaffinfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStaffinfoRequest $request)
    {
        $staffinfo = $this->staffinfoRepository->find($id);

        if (empty($staffinfo)) {
            Flash::error('スタッフ情報が見つかりません');

            return redirect(route('staffinfos.index'));
        }

        $staffinfo = $this->staffinfoRepository->update($request->all(), $id);

        Flash::success('スタッフ情報を更新しました');

        return redirect(route('staffinfos.index'));
    }

    /**
     * Remove the specified Staffinfo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $staffinfo = $this->staffinfoRepository->find($id);

        if (empty($staffinfo)) {
            Flash::error('スタッフ情報が見つかりません');

            return redirect(route('staffinfos.index'));
        }

        $this->staffinfoRepository->delete($id);

        Flash::success('スタッフ情報を削除しました');

        return redirect(route('staffinfos.index'));
    }

    public function digipass(Request $request)
    {
        $staff = Staffinfo::where('user_id', Auth::user()->id)->with('user')->first();
        // dd($staff);

        if (isset($staff)) {
            return view('mypage.staff')
                ->with('staff', $staff);
        }
    }

    public function arrive(Request $request)
    {
        $staff = Staffinfo::where('user_id', Auth::user()->id)->with('user')->first();
        // dd($staff);

        if (isset($staff)) {
            $staff->checkedin_at = now();
            $staff->save();
            Flash::success('チェックインしました');
            return view('mypage.staff')
                ->with('staff', $staff);
        }
    }

    public function staff_checkin(Request $request)
    {
        $uuid = $request['uuid'];
        $checkin = $request['checkin'];
        $staff = Staffinfo::where('uuid', $uuid)->with('user')->first();

        if (isset($staff) && empty($checkin)) {
            return view('mypage.pr_staff')
                ->with('staff', $staff);
        }

        if (isset($staff) && $checkin == 'true') {
            $staff->checkedin_at = now();
            $staff->save();
            Flash::success('チェックインしました');
            return view('mypage.pr_staff')
                ->with('staff', $staff);
        }
    }
}
