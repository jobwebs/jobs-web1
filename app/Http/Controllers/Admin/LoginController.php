<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\about;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;
use Auth;
use App\admininfo;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('logout');  //除了logout方法
    }
    public function postLogin(Request $request)
    {
        $input = $request->all();
        $username = $input['username'];
        $password = $input['password'];
        if(Auth::attempt(array('username'=>$username,'password'=>$password)))
        {
            $uid = Auth::user()->uid;
            $type =User::where('uid','=',$uid)
                ->select(['type'])
                ->get();
            $type = $type[0]['type'];
            session()->put('type',$type);
            $last_login = date('Y-m-d H-i-s',time());
            $admin = Admininfo::where('uid',$uid)->get();
            $admin->last_login = $last_login;
            $admin->save();
            return redirect('admin/dashboard');
        }
        else{
            return redirect('admin/login');
        }
    }
    //登出函数
    public function logout(){
        Auth::logout();
        Session::flush();   //清除所有缓存
        return redirect('index');
    }
}