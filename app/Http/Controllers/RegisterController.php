<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;


use App\Enprinfo;
use App\Personinfo;
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
        $data = array();
        $input = $request->all();
        if ($request->has('phone'))     //手机注册
        {
            //手机短信验证码匹配???
            $code = $request->input('code');
            $validator = Validator::make($input, [
                'tel' => 'required|regex:/^1[34578][0-9]{9}$/|unique:jobs_users,tel',
                'password' => 'required|min:6|max:60',
                'passwordConfirm' => 'required|same:password',
                'type' => 'required|integer'
            ]);
            if ($validator->fails()) {
                $data['status'] = 400;
                $data['msg'] = "手机格式输入错误";
                return $data;
            }
            if (ValidationController::verifySmsCode($input['tel'], $code)) {//验证码正确
                $user = new User();
                $user->tel = $input['tel'];
                $user->password = bcrypt($input['password']);
                $user->type = $input['type'];
                $user->username = substr($input['tel'], -4);
                $user->tel_vertify = 1;

                if ($user->save()) {
                    if ($input['type'] == 1) {//个人用户
                        $perinfo = new Personinfo();
                        $perinfo->uid = $user->uid;
                        $perinfo->register_way = 0;
                        $perinfo->save();

                    } else if ($input['type'] == 2) {//企业用户
                        $enprinfo = new Enprinfo();
                        $enprinfo->uid = $user->uid;
                        $enprinfo->save();
                    }
                    $data['status'] = 200;
                    $data['msg'] = "注册成功！";
                    return $data;
                }

                $data['status'] = 400;
                $data['msg'] = "数据库插入错误！";
                return $data;
            } else {
                $data['status'] = 400;
                $data['msg'] = "验证码错误";
                return $data;
            }

        } else if ($request->has('mail'))     //邮箱注册
        {
            //邮箱验证码匹配???
            $validator = Validator::make($input, [
                'mail' => 'required|string|email|unique:jobs_users,mail',
                'password' => 'required|min:6|max:60',
                'passwordConfirm' => 'required|same:password',
                'type' => 'required|integer'
            ]);
            if ($validator->fails()) {
                $data['status'] = 400;
                $data['msg'] = "邮箱信息格式有误";
                return $data;
            }else{
                //检查该邮箱是否已经被注册
                $isexist = Users::where('mail','=',$input['mail'])->get();
                if($isexist->count()) {
                    if ($isexist->email_vertify == 1){//已注册{
                        $data['status'] = 400;
                        $data['msg'] = "该用户已注册！请直接登录";
                        return $data;
                     }
                  //邮箱已发送过验证码，重新发送验证码
                    $mailAgain = ValidationController::sendemail($input['mail'],$isexist->uid);
                    if($mailAgain ==-1){
                        $data['status'] = 400;
                        $data['msg'] ="验证邮件发送失败！";
                        return $data;
                    }
                    $data['status'] = 200;
                    $data['msg'] ="验证邮件发送成功！";
                    return $data;
                }
                $username = explode('@',$input['mail']);
                $user = new User();
                $user->mail = $input['mail'];
                $user->password = bcrypt($input['password']);
                $user->type = $input['type'];
                $user->username = $username[0];

                $type = $input['type'];
                if ($user->save()) {
                    if ($input['type'] == 1) {//个人用户
                        $perinfo = new Personinfo();
                        $perinfo->uid = $user->uid;
                        $perinfo->register_way = 1;
                        $perinfo->save();

                    } else if ($input['type'] == 2) {//企业用户
                        $enprinfo = new Enprinfo();
                        $enprinfo->uid = $user->uid;
                        $enprinfo->save();
                    }
                    //发送验证邮件
                    $mailstatus = ValidationController::sendemail($input['mail'],$user->uid);
                    if($mailstatus ==-1){
                        $data['status'] = 400;
                        $data['msg'] ="验证邮件发送失败！";
                        return $data;
                    }
                    $data['status'] = 200;
                    $data['msg'] ="注册成功";
                    return $data;
                } else {
                    $data['status'] = 400;
                    $data['msg'] ="数据库插入错误!";
                    return $data;
                }
            }

        }
    }
}
