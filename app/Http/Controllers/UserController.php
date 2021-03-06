<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Organization;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUsers(){
        if(Auth::user()->permission != 1){
            return view("permission.permissionError");
        }
        else{
            $provinces = DB::table('tb_province')
                ->orderBy('provName', 'ASC')
                ->get();
            $organizations = Organization::orderBy('fullName')->get();
            return view('User.userShow', compact('provinces', 'organizations'));
        }
    }

    public function getUsers(){
        $users = DB::table('users')
            ->join('users_permission', 'users.permission', '=', 'users_permission.id')
            ->select(
                'users.*', 'users_permission.permissionName',
                DB::raw('(select provName from tb_province where provCode=users.aimagCode) as provName'),
                DB::raw('(select abbrName from tb_organizations where id=users.organizationID) as abbrOrgName')
            )
            ->get();
        return DataTables::of($users)
          ->make(true);
    }

    public function update(Request $req){
        try{
            if($req->permission == 1){
                $provCode = 0;
                $orgID = 0;
            }
            if($req->permission == 2){
                $provCode = $req->aimagCode;
                $orgID = 0;
            }
            if($req->permission == 3){
                $provCode = 0;
                $orgID = $req->organization;
            }
            $user = User::find($req->id);
            $user->name = $req->name;
            $user->email = $req->email;
            $user->permission = $req->permission;
            $user->aimagCode = $provCode;
            $user->organizationID = $orgID;
            $user->save();

            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }

    public function changePassword(Request $req){
        try{
            $user = User::find($req->id);
            $user->password = Hash::make($req->password);
            $user->save();

            $array = array(
                'status' => 'success',
                'msg' => 'Нууц үг амжилттай солилоо!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }

    public function deleteUsers(Request $req){
        try{
            User::where('id',$req->id)->delete();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай устгалаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }
}
