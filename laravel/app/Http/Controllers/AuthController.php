<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Contracts\Services\User\UserServiceInterface;


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

    public function Index()
    {
        return view('auth.login');
    }

    public function UserCustomLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        return $this->authInterface->saveUserCustomLogin($request);
    }

    public function UserRegistration()
    {
        return view('auth.registration');
    }

    public function UserCustomRegistration(RegisterFormRequest $request)
    {
        $data = $request->validated();
        $this->userCreate($data);

        return redirect("/")->withSuccess('You have signed-in');
    }

    public function userCreate($data)
    {
        $user = $this->userInterface->createUser($data);
        return $user;
    }

    public function savePhoto($profile)
    {
        return $this->userInterface->savePhoto($profile);
    }

    public function userDashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("/")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        return $this->authInterface->logout();
    }

    //userList function
    public function showUserList(Request $request)
    {
        $userLists = $this->userInterface->getUserList($request);
        return view('user_list', ['userLists' => $userLists]);
    }

    //delete user
    public function deleteUser($id)
    {
        $this->userInterface->deleteUser($id);
        return redirect('/user-list');
    }

    //show userdetails
    public function userdetail($id)
    {
        $detail = User::find($id);
        return view('userdetails', ['detail' => $detail]);
    }

    //Edit user
    public function editUser($id)
    {
        $userEdit = $this->userInterface->editUser($id);
        return view('update_user', ['userEdit' => $userEdit]);
    }

    //Update user
    public function updateUser($id, Request $request)
    {
        $this->userInterface->updateUser($id, $request);

        if (Auth::user()->role_id == 1) {
            return redirect('/student/' . Auth::user()->id);
        }
        else {
            return redirect('/teacher/' . Auth::user()->id);
        }
    }
}
