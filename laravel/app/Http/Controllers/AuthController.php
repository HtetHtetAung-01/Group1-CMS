<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\Auth\AuthServiceInterface;
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

  public function Index()
  {
    return view('auth.login');
  }

  public function UserCustomLogin(Request $request)
  {
    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      if (Auth::user()->role_id == 1) {
        return redirect('/student/' . Auth::user()->id);
      } elseif (Auth::user()->role_id == 2) {
        return redirect('/teacher/' . Auth::user()->id);
      } else {
        return redirect('/admin/' . Auth::user()->id);
      }
    } else {
      $message = "";
      $checkUser = User::where('email', $request->email)->first();
      if ($checkUser) {
        $checkPassword = Hash::check($request->password, $checkUser->password);
        if (!$checkPassword) {
          $message .= "Incorrect Password";
        }
      } else {
        $message .= "Your email is not registered in the system";
      }
      return redirect()->back()->with('message', $message);
    }
  }

  public function UserRegistration()
  {
    return view('auth.registration');
  }

  public function UserCustomRegistration(RegisterFormRequest $request)
  {
    $data  = $request->validated();
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
    $this->userInterface->SavePhoto($profile);
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
    Session::flush();
    Auth::logout();

    return Redirect('/');
  }

  //userList function
  public function showUserList(Request $request)
  {
    $userLists = $this->userInterface->getUserList($request);
    return view('user_list', compact('userLists'));
  }

  //delete user
  public function deleteUser($id)
  {
    // User::findOrFail($id)->delete();
    $this->userInterface->deleteUser($id);
    return redirect('/user-list');
  }

  //show userdetails
  public function userdetail($id)
  {
    $detail = User::find($id);
    return view('userdetails', compact('detail'));
  }

  //Edit user
  public function editUser($id)
  {
    // $userEdit= User::find($id);
    $userEdit = $this->userInterface->editUser($id);
    return view('update_user', compact('userEdit'));
  }

  //Update user
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
