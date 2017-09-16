<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/16
 * Time: 21:09
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Hash;

class FixPasswordController extends Controller
{
    //重置密码需要再账户登录的状态下
    public function resetPassword(Request $request)
    {
        $data = array();
        $input = $request->all();
        $rules = [
            'oldPassword'=>'required|between:6,60',
            'password' => 'required|between:6,60',
            'passwordConfirm' =>'required|same:password'
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return back();
        }
        $id = AuthController::getUid();
        $oldPassword = $request->input('oldPassword');
        $password = $request->input('password');
        $res = DB::table('jobs_users')->where('uid','=',$id)->select('password')->first();
        if(!Hash::check($oldPassword, $res->password)){
            $data['status'] = 400;
            $data['msg'] = '原密码不正确';
            return $data;
        }
        $update = array(
            'password' =>bcrypt($password),
        );
        $result = DB::table('jobs_users')->where('uid',$id)->update($update);
        if($result){
            $data['status'] = 200;  //更改密码成功
            $data['msg'] = '密码重置成功';
        }else{
            $data['status'] = 400;  //更改密码失败
            $data['msg'] = '密码重置成功';
        }
        $object = new LoginController();
        $object->logout();
        return redirect('account/login');
    }
}