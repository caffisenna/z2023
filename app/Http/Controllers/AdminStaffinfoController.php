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

class AdminStaffinfoController extends AppBaseController
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
        $staffinfos = Staffinfo::with('user')->get();

        return view('admin_staffinfos.index')
            ->with('staffinfos', $staffinfos);
    }

    /**
     * Show the form for creating a new Staffinfo.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin_staffinfos.create');
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
        // $input['user_id'] = Auth::user()->id;

        $staffinfo = $this->staffinfoRepository->create($input);

        Flash::success('スタッフ情報を登録しました');

        return redirect(route('admin_staffinfos.index'));
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

        if (empty($staffinfo)) {
            Flash::error('スタッフ情報が見つかりません');

            return redirect(route('admin_staffinfos.index'));
        }

        return view('admin_staffinfos.show')->with('staffinfo', $staffinfo);
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
        // 氏名を取得するのにUserをwithで取る
        $staffinfo = Staffinfo::where('id',$id)->with('user')->first();

        if (empty($staffinfo)) {
            Flash::error('スタッフ情報が見つかりません');

            return redirect(route('admin_staffinfos.index'));
        }

        return view('admin_staffinfos.edit')->with('staffinfo', $staffinfo);
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

            return redirect(route('admin_staffinfos.index'));
        }

        $staffinfo = $this->staffinfoRepository->update($request->all(), $id);

        Flash::success('スタッフ情報を更新しました');

        return redirect(route('admin_staffinfos.index'));
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

            return redirect(route('admin_staffinfos.index'));
        }

        $this->staffinfoRepository->delete($id);

        Flash::success('スタッフ情報を削除しました');

        return redirect(route('admin_staffinfos.index'));
    }
}
