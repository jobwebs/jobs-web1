<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/13
 * Time: 0:00
 */

namespace App\Http\Controllers;
use App\Education;
use App\Enprinfo;
use App\Message;
use App\Position;
use Illuminate\Http\Request;

class PersonCenterController extends Controller
{
    public function getPersonAccount()
    {
        if($flag = AuthController::personVertify())
        {
            $data = array();
            $resume = new ResumeController();
            $data['ResumeList'] = $resume->getResumeList();
            $info = new InfoController();
            $data['personInfo'] = $info->getPersonInfo();
            $data['recommendPostion'] = $this->recommendPostion();
            $data['messageNum'] = $this->getMessageNum();
            $data['deliveredNum'] = $this->getDeliveredNum();
            return $data;
        }else{
            return "非个人用户";
        }
    }
    public function recommendPostion()
    {

        $uid = AuthController::getUid();
        $intentions = DB::table('jobs_personinfo')->join('jobs_intetion','jobs_personinfo.uid','=','jobs_intetion.uid')
                    ->where('uid','=',$uid)
                    ->select('sex','work_nature','occupation','industry','region','salary')
                    ->get();
        $result = array();
        $education = Education::where('uid','=',$uid)
                   ->orderBy('degree','desc')
                   ->first();//获取最高学历
        foreach ($intentions as $intention)
        {
            $result[] = Position::where('position_status','=',1)
                    ->where('work_nature','=',$intention['work_nature'])
                    ->where('education','<=',$education)
                    ->orWhere('industry','=',$intention['industry'])
                    ->orWhere('occupation','=',$intention['occupation'])
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
    //todo 军哥投递那边还没有完成
    public function getDeliveredNum()
    {
    }


    //获取企业用户信息
    public function getEnterpriseAccount()
    {
        if(($flag = AuthController::enterpriseVertify()))
        {
            $data = array();
            $info = new InfoController();
            $data['enterpriseInfo'] = $info->getEnprInfo();
            $data['positonList'] = $this->getPostionList();
            $data['messageNum'] = $this->getMessageNum();
            $data['applyList'] = $this->getApplyList();
            return $data;
        }else{
            return "非企业用户";
        }


    }
    public function getPostionList()
    {
        $uid = AuthController::getUid();
        $eid = Enprinfo::where('uid','=',$uid)
             ->get();
        $eid = $eid[0]['eid'];
        $result = Position::where('eid','=',$eid)
                ->where('position_status','=',1)
                ->select('title','describe')
                ->get();
        return $result;
    }
    //todo 等军哥的记录
    public function getApplyList()
    {}

}