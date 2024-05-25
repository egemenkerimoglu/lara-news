<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get_all()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'message'=>'Kullanıcılar Liselendi.',
            'users' => $users,
        ]);
    }

    public function create_user(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kullanıcı başarıyla oluşturuldu.',
            'data' => $user
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        $user = Auth::attempt(['email'=>$request->email,'password'=>$request->password]);

        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=> 'Kullanıcı bulunamadı',
            ]);
        }

        return response()->json([
            'status'=>true,
            'message'=> 'Kullanıcı başarıyla giriş yaptı.',
            'data'=> Auth::user(),
        ]);

    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'Kullanıcı başarıyla çıkış yaptı.'
        ]);
    }

    public function get_user_from_id(int $user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Kullanıcı bulunamadı.'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Kullanıcı bilgileri başarıyla getirildi.',
            'data' => $user
        ]);
    }
}
