<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * User Interface
     */
    private $userInterface;


    /**
     * Create a new controller instance.
     * @param UserServiceInterface $userServiceInterface
     * @return void
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userInterface = $userServiceInterface;
    }

    /**
     * show the login page
     * @return view auth.login
     */
    public function Index()
    {
        return view('auth.login');
    }

    /**
     * user custom login
     * @param Request $request
     * @return redirect()->back()
     */
    public function UserCustomLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == 1) {
                return redirect('/student/' . 
                Auth::user()->id . '/dashboard');
            } 
            elseif (Auth::user()->role_id == 2) {
                return redirect('/teacher/' .
                 Auth::user()->id . '/dashboard');
            } 
            else {
                return redirect('/admin/' . Auth::user()->id);
            }
        } else {
            $message = "";
            $checkUser = User::where('email', $request->email)
                                ->first();
            if ($checkUser) {
                $checkPassword = Hash::check($request->password, 
                                            $checkUser->password);
                if (!$checkPassword) {
                    $message .= "Incorrect Password";
                }
            } else {
                $message .= "Your email is not registered in the system";
            }
            return redirect()->back()->with('message', $message);
        }
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
        $data  = $request->validated();
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
        $this->userInterface->SavePhoto($profile);
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
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

    /**
     * show user list
     * @param Request $request
     * @return view user_list
     */
    public function showUserList(Request $request)
    {
        $userLists = $this->userInterface->getUserList($request);
        return view('user_list', compact('userLists'));
    }

    /**
     * delete user
     * @param $id
     * @return redirect('/user-list')
     */
    public function deleteUser($id)
    {
        $this->userInterface->deleteUser($id);
        return redirect('/user-list');
    }

    /**
     * show user details
     * @param $id
     * @return view userdetails
     */
    public function userdetail($id)
    {
        $detail = User::find($id);
        return view('userdetails', compact('detail'));
    }

    /**
     * edit user
     * @param $id
     * @return view update_user
     */
    public function editUser($id)
    {
        $userEdit = $this->userInterface->editUser($id);
        return view('update_user', compact('userEdit'));
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
        if (Auth::user()->role_id == 1) {
            return redirect('/student/' . Auth::user()->id);
        } else {
            return redirect('/teacher/' . Auth::user()->id);
        }
    }
}
