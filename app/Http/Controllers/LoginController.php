<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');  //除了logout方法
    }
    /*登录验证逻辑*/
    public function postLogin(Request $request)
    {
        $input = $request->all();
        $username = $input['username'];
        $password = $input['password'];

        $validatorTel = Validator::make($input, [
            'username' => 'required|regex:/^1[34578][0-9]{9}$/',
            'password' => 'required|min:6|max:60'
        ]);
        $validatorMail = Validator::make($input, [
            'username' => 'required|string|email',
            'password' => 'required|min:6|max:60'
        ]);
        if (!($validatorTel->fails())) {
            if (Auth::attempt(array('tel' => $username, 'password' => $password))) {
                $uid = Auth::user()->uid;
                $type =User::where('uid','=',$uid)
                    ->select('type')
                    ->get();
                $type = $type[0]['type'];
                session()->put('type',$type);
                return redirect('index')->with('success', '登录成功');
            } else {
                return redirect()->back()->with('error', '登录失败');
            }
        } else if (!($validatorMail->fails())) {
            if (Auth::attempt(array('mail' => $username, 'password' => $password))) {
                $uid = Auth::user()->uid;
                $type =User::where('uid','=',$uid)
                    ->select(['type'])
                    ->get();
                $type = $type[0]['type'];
                session()->put('type',$type);
                return redirect('index')->with('success', '登录成功');
            } else {
                return redirect()->back()->with('error', '登录失败');
            }
        } else {
            return redirect()->back()->with('error', '登录信息格式不符合规范');
        }
    }

    //登出函数
    public function logout(){
        Auth::logout();
        Session::flush();   //清除所有缓存
        return;
    }

}
