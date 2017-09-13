<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/11
 * Time: 15:52
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admininfo;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function addAdmin(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'username' => ['required','max:20','regex:/^[a-zA-Z0-9!"#$%&\'()*+,-.\/:;<=>?^_`~{|}\]]+$/','unique:jobs_users,username'],
            'password' => 'required|min:6|max:60',
            'passwordConfirm' =>'required|same:password'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error','注册信息格式有误');
        }
        $user = new User();
        $user->username = $input['username'];
        $user->password = bcrypt($input['password']);
        $user->type = 3;
        if($user->save())
        {
            $adminInfo = new Admininfo();
            $adminInfo->uid = $user->uid;
            $adminInfo->save();
            return $user;
        }else{
            return "管理员添加失败";
        }
    }
    public function deleteAdmin($uid,$aid)
    {
        $admin = Admininfo::find($aid);
        $admin->delete;
        $user = User::find($uid);
        $user->delete;
    }
}