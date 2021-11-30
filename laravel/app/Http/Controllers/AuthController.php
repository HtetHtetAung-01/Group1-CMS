<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * User Interface
     * Auuth AuthInterface
     */
    private $userInterface;
    private $authInterface;


    /**
     * Create a new controller instance.
     * @param UserServiceInterface $userServiceInterface
     * @param AuthServiceInterface $authServiceInterface
     * @return void
     */
    public function __construct(UserServiceInterface $userServiceInterface,
        AuthServiceInterface $authServiceInterface)
    {
        $this->userInterface = $userServiceInterface;
        $this->authInterface = $authServiceInterface;
    }

    /**
     * show the login page
     * @return view auth.login
     */
    public function Index()
    {
        return view('auth.login');
    }

    public function UserCustomLogin(LoginFormRequest $request)
    {
        return $this->authInterface->saveUserCustomLogin($request);
    }

    /**
     * show user registration page
     * @return view auth.registeration
     */
    public function UserRegistration()
    {
        return view('auth.registration');
    }

    /**
     * user custom registeration
     * @param RegisterFormRequest $request
     * @return redirect('/')
     */
    public function UserCustomRegistration(RegisterFormRequest $request)
    {
        $data = $request->validated();
        $this->userCreate($data);

        return redirect("/")->withSuccess('You have signed-in');
    }

    /**
     * create new user
     * @param $data
     * @return $user
     */
    public function userCreate($data)
    {
        $user = $this->userInterface->createUser($data);
        return $user;
    }

    /**
     * save photo
     * @param $profile
     */
    public function savePhoto($profile)
    {
        return $this->userInterface->savePhoto($profile);
    }

    /**
     * show user dashboard
     * @return view 'dashboard'
     */
    public function userDashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("/")->
                withSuccess('You are not allowed to access');
    }

    /**
     * signout
     * @return redirect('/')
     */
    public function signOut()
    {
        return $this->authInterface->logout();
    }

    /**
     * show user details
     * @param $id
     * @return view userdetails
     */
    public function userdetail($id)
    {
        $detail = User::find($id);
        return view('user.details', ['detail' => $detail]);
    }

    /**
     * edit user
     * @param $id
     * @return view update_user
     */
    public function editUser($id)
    {
        $userEdit = $this->userInterface->editUser($id);
        return view('user.update', ['userEdit' => $userEdit]);
    }

    /**
     * update user
     * @param $id
     * @param Request $request
     * @return redirect('/student/') or ('/teacher/')
     */
    public function updateUser($id, Request $request)
    {
        $this->userInterface->updateUser($id, $request);

        switch(Auth::user()->role_id) {
            case 1:
                return redirect()->route('student.dashboard', ['id' => Auth::user()->id]);
                break;
            case 2:
                return redirect()->route('teacher.dashboard', ['id' => Auth::user()->id]);
                break;
            case 3:
                return redirect()->route('admin-home', ['id' => Auth::user()->id]);
                break;
        }
    }
}
