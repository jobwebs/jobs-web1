<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Tempemail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Helper\Table;
use APP\Models\E3Email;

require (app_path() . '/lib/BmobSms.class.php');
require (app_path() . '/Models/E3Email.php');

class ValidationController extends Controller
{
    public function sendSMS (Request $request)
    {
        if($request->has('telnum')) {
            $mytel = $request->input('telnum');
            $bmobSms = new \BmobSms();
            $res = $bmobSms->sendSmsVerifyCode($mytel, "电竞猎人");
            //var_dump($res);
            if($res){
                return "短信发送成功";
//                return  redirect()->back()->with('success',"短信发送成功");
            }
        }
        return "短信发送失败";
        //return  redirect()->back()->with('error',"短信发送失败");
    }
    public function verifySmsCode(Request $request)
    {
        if ($request->has('smscode') && $request->has('telnum')) {
            $smscode = $request->input('smscode');
            $mytel = $request->input('telnum');
                //验证短信验证码是否正确
                $bmobSms = new \BmobSms();
                $res = $bmobSms->verifySmsCode($mytel, $smscode);

                if($res){
                    return "验证码正确！";
                }
                //var_dump($res);
        }
        return "验证码错误";
    }

    /**
     * @param Request $request
     * @return string
     */
    public function sendemail(Request $request)
    {
        if($request->input('toemail')){
            $toemail = $request->input('toemail');
            $uid = $request->session()->get('uid','');
            if($uid ==''){
                return "未登陆";
                exit;
            }
            //查询该用户是否已经发过验证邮件
            $res = Tempemail::where('uid','=',$uid)
                ->get();
            //var_dump($res);
            //判断结果是否为空
            //if ($result->first()) { }
            //if (!$result->isEmpty()) { }
            //if ($result->count()) { }
            if(!$res->isEmpty()){
                if($res->deadline >=date('Y-m-d H-i-s')){
                    return "验证邮箱已经发送，请注意查收！";
                }
            }
            //if($res->)

            $ecode =ValidationController::generate_rand();
            $e3_email = new E3Email();
            $e3_email->from = "631642753@qq.com";
            $e3_email->to = $toemail;
            $e3_email->subject = "电竞网验证";
            $e3_email->content = "请于24小时内点击该链接，完成验证。http://localhost/laravel/public/validate_email"
                ."?uid=".$uid
                .'&code='.$ecode;
            //发送纯文本邮件
            Mail::raw($e3_email->content,function ($message)use ($e3_email){
                $message->from($e3_email->from,'jkjun官网');
                $message->subject($e3_email->subject);
                $message->to($e3_email->to);
            });
            //保存已发送的邮箱验证码
            //还未考虑同一用户重复多次发送邮件验证，或已经失效后重新发送邮件。
            if(!$res->isEmpty()){
                $res->code =$ecode;
                $res->deadline = date('Y-m-d H:i:s',strtotime('+1 day'));
                $bool = $res->save();
                return $bool;
            }
            $temp = new Tempemail();
            $temp->code = $ecode;
            $temp->uid = $uid;
            $temp->deadline = date('Y-m-d H:i:s',strtotime('+1 day'));
            $temp->save();

            return "发送邮件成功！";
            //发送html邮件
//            $name = '王宝花';
//            $flag = Mail::send('emails.test',['name'=>$name], function($message){
//                $to = '282584778@qq.com';
//                $message ->to($to)->subject('邮件测试'); });
//            if($flag){
//                echo '发送邮件成功，请查收！';
//            }else{
//                echo '发送邮件失败，请重试！';
//            }
        }else{
            return "没有发送邮箱";
        }

    }
    //验证邮箱链接
    public function verifyEmailCode(Request $request)
    {
        if($request->has('uid') && $request->has('code')){
            $uid = $request->input('uid');
            $code = $request->input('code');
            echo $uid;
            echo "</br>";
            echo $code;
            $num = Tempemail::whereRaw('uid =? and code =? and deadline >=?',[$uid,$code,date('Y-m-d H-i-s')])
                ->count();
            var_dump(date('Y-m-d H-i-s'));
            var_dump($num);
            if($num){
                return "邮箱验证成功";
            }
        }

        return "邮箱验证失败!";

    }
    //生成32位随机验证码
    public function generate_rand() {
        $c= "abcdefghijklmnopqrstuvwxyz0123456789";
        $rand = '';
        srand((double)microtime()*1000000);
        for ($i=0; $i<32; $i++) {
            $rand .= $c[rand() % strlen($c)];
        }
        $restr = $rand;
        return $restr;
    }
}