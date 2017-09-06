<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    /*注册验证逻辑*/
    public function postRegister (Request $request)
    {
        $input = $request->all();
        if($request->has('tel'))     //手机注册
        {
            //手机短信验证码匹配???
            $validator = Validator::make($input,[
                'tel' =>'required|regex:/^1[34578][0-9]{9}$/|unique:jobs_users,tel',
                'password' => 'required|min:6|max:60',
                'passwordConfirm' =>'required|same:password',
                'type' =>'required|integer'
            ]);
            if ($validator->fails()) {
//                $data = array();
//                $data['message'] = "手机注册信息格式有误";
//                return $data;
                return redirect()->back()->with('error','手机注册信息格式有误');
            }
            $user = new User();
            $user->tel = $input['tel'];
            $user->password = bcrypt($input['password']);
            $user->type = $input['type'];
            $type = $input['type'];
            session()->put('type',$type);
            if($user->save())
            {
                return redirect('index')->with('success','手机注册成功');
            }
        }
        if($request->has('mail'))     //邮箱注册
        {
            //邮箱验证码匹配???
            $validator = Validator::make($input,[
                'mail' => 'required|string|email|unique:jobs_users,mail',
                'password' => 'required|min:6|max:60',
                'passwordConfirm' =>'required|same:password',
                'type' =>'required|integer'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error','邮箱注册信息格式有误');
            }
        }
        $user = new User();
        $user->mail = $input['mail'];
        $user->password = bcrypt($input['password']);
        $user->type = $input['type'];
        $type = $input['type'];
        session()->put('type',$type);
        if($user->save())
        {
            return redirect('index')->with('success','邮箱注册成功');
        }
    }
}
