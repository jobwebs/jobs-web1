<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/13
 * Time: 0:00
 */

namespace App\Http\Controllers;
use App\Message;
use App\Position;
use Illuminate\Http\Request;

class PersonCenterController extends Controller
{
    public function recommendPostion()
    {
//        $flag = AuthController::personVertify();   //进行权限认证
        $uid = AuthController::getUid();
        $intentions = DB::table('jobs_personinfo')->join('jobs_intetion','jobs_personinfo.uid','=','jobs_intetion.uid')
                    ->where('uid','=',$uid)
                    ->select('sex','age','education','work_nature','occupation','industry','region','salary')
                    ->get();
        $result = array();
        foreach ($intentions as $intention)
        {
            $result[] = Position::where('position_status','=',1)
                    ->where('work_nature','=',$intention['work_nature'])
                    ->where('education','<=',$intention['education'])
                    ->get();
        }
        $result[] = Position::where('position_status','=',1)
                  ->where('is_urgency','=',1)
                  ->get();
        //需要让多维数组变成一维数组
        return $result;
    }
    public function getMessageNum()
    {
        $uid = AuthController::getUid();
        $num = Message::where('to_id','=',$uid)
            ->where('is_read','=','0')
            ->count();
        if($num > 99)
            return 99;
        else
            return $num;
    }
    public function getDeliveredNum()
    {

    }
}