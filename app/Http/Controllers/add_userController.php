<?php

namespace App\Http\Controllers;

use App\Repositories\add_userRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\User;

class add_userController extends AppBaseController
{
    /** @var add_userRepository $addUserRepository*/
    private $addUserRepository;

    public function __construct(add_userRepository $addUserRepo)
    {
        $this->addUserRepository = $addUserRepo;
    }

    /**
     * Display a listing of the add_user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $addUsers = User::all();
        foreach($addUsers as $val){
            if($val['is_admin'] == 1){
                $val['role'] = "管理者";
            }elseif($val['is_staff'] == 1){
                $val['role'] = "スタッフ";
            }
        }

        return view('add_users.index')
            ->with('addUsers', $addUsers);
    }

    /**
     * Show the form for creating a new add_user.
     *
     * @return Response
     */
    public function create()
    {
        return view('add_users.create');
    }

    /**
     * Store a newly created add_user in storage.
     *
     * @param Createadd_userRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = new User();

        // 権限
        if ($input['role'] == '管理者') {
            $input['is_admin'] = 1;
            $input['is_staff'] = 1;
        } elseif ($input['role'] == 'スタッフ') {
            $input['is_staff'] = 1;
        }

        $user = User::create($input);
        $user->save();

        Flash::success('Add User saved successfully.');

        return redirect(route('addUsers.index'));
    }

    /**
     * Remove the specified add_user from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $addUser = $this->addUserRepository->find($id);
        $addUser = User::find($id);

        if (empty($addUser)) {
            Flash::error('Add User not found');

            return redirect(route('addUsers.index'));
        }

        // $this->addUserRepository->delete($id);
        User::destroy($id);

        Flash::success('Add User deleted successfully.');

        return redirect(route('addUsers.index'));
    }
}
