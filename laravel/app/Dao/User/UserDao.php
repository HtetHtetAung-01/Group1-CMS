<?php

namespace App\Dao\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\User\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserDao constructor,
     * 
     * @param User $user
     */

    public function __construct(User $user)
    {
        $this->user=$user;
    }

    public function createUser($data)
    {
        $profile=$data['photo'];

        $user=User::create([
            'name'             => $data['name'],
            'photo'            => $this->savePhoto($profile),
            'date_of_birth'    =>$data['date_of_birth'],
            'gender'           => $data['gender'],
            'role_type'        => $data['role_type'],
            'email'            => $data['email'],
            'password'         => Hash::make($data['password']),
            'confirm_password' =>Hash::make($data['confirm_password']),
            'phone_number'     => $data['phone_number'],
            'address'          =>$data['address'],
        ]);
        return $user;
    }
    
    public function savePhoto($profile){
        $profileName=$profile->getClientOriginalName();
        $imagePath  = "storage/photos/".$profileName;
        $profile->storeAs('/public/photos',$profileName);
        return $imagePath;
    }

    public function getUserList($request)
    {
        $userLists=User ::all();
        return $userLists;
    }
    
    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
    }

    public function editUser($id)
    {
        $userEdit= User::find($id);
        return $userEdit;
    }

    public function updateUser($id, $request)
    {
        $userinformation=User::find($id);
        $userinformation->name=$request->name;
        if($request->is_update == 1){
            $profile= $request->photo;
            $userinformation->photo= $this->savePhoto($profile);
        }
      
        $userinformation->date_of_birth=$request->date_of_birth;
        $userinformation->gender=$request->gender;
        $userinformation->role_type=$request->role_type;
        $userinformation->email=$request->email;
        $userinformation->address=$request->address;
        $userinformation->phone_number=$request->phone_number;
        $userinformation->save();
        return $userinformation;
    }
}