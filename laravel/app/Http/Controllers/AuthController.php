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

    /**
     * To view the login page
     * @return view auth.login
     */
    public function Index()
    {
        return view('auth.login');
    }  
      
    /**
     * To view the login page
     * @param $request
     * @return redirect back()
     */
    public function UserCustomLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if( Auth::user()->role_id == 1){
               return redirect('/student/'.Auth::user()->id);
            }
            elseif( Auth::user()->role_id == 2){
                return redirect('/teacher/'.Auth::user()->id);
            }else{
                return redirect('/admin/'.Auth::user()->id);
            }

        }
        else{
            $message = "";
            $checkUser = User::where('email',$request->email)->first();
            if($checkUser){
                $checkPassword = Hash::check($request->password, $checkUser->password);
                if(!$checkPassword){
                    $message .= "Incorrect Password";
                }
            }else{
                $message .= "Your email is not registered in the system";
            }
            return redirect()->back()->with('message',$message);
        }
    }

    /**
     * To view the login page
     * @return view auth.registration
     */
    public function UserRegistration()
    {
        return view('auth.registration');
    }

    /**
     * To view the login page
     * @param $request
     * @return redirect "login"
     */
    public function UserCustomRegistration(RegisterFormRequest $request)
    {  
        $data  = $request->validated();
        $this->userCreate($data);
         
        return redirect("login")->withSuccess('You have signed-in');
    }

    /**
     * To view the login page
     * @param $data
     * @return $user
     */
    public function userCreate($data)
    {   
        $user=$this->userInterface->createUser($data);
        return $user;
    }    

    /**
     * To view the login page
     * @param $profile
     */
    public function savePhoto($profile)
    {
        $this->userInterface->SavePhoto($profile);
    }
 
    /**
     * To view the login page
     * @return view dashboard
     */
    public function userDashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
 
    /**
     * To view the login page
     * @return redirect "login"
     */
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    /**
     * To view the login page
     * @param $request
     * @return view user_list
     */
    public function showUserList(Request $request)
    {
        $userLists=$this->userInterface->getUserList($request);
        return view('user_list', compact('userLists'));
    }

    /**
     * To view the login page
     * @param $id
     * @return redirect "/user-list"
     */
    public function deleteUser($id)
    {
        // User::findOrFail($id)->delete();
        $this->userInterface->deleteUser($id);
        return redirect('/user-list');
    } 
    
    /**
     * To view the login page
     * @param $id
     * @return view 'userdetils'
     */
    public function userdetail($id)
    {
       $detail= User::find($id);
        return view('userdetails',compact('detail'));
    }

    /**
     * To view the login page
     * @param $id
     * @return view 'update_user'
     */
    public function editUser($id)
    {
        // $userEdit= User::find($id);
        $userEdit=$this->userInterface->editUser($id);
        return view('update_user',compact('userEdit'));
    }

    /**
     * To view the login page
     * @param $id, $request
     * @return redirect '/student/{id}' or '/teacher/{id}'
     */
    public function updateUser($id,Request $request)
    {
        $this->userInterface->updateUser($id, $request);
        if( Auth::user()->role_id == 1){
            return redirect('/student/'.Auth::user()->id);
         }else{
             return redirect('/teacher/'.Auth::user()->id);
        }
    }
}
