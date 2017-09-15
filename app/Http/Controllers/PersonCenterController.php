<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/13
 * Time: 0:00
 */

namespace App\Http\Controllers;

use App\Backup;
use App\Delivered;
use App\Education;
use App\Enprinfo;
use App\Message;
use App\Position;
use Faker\Provider\lv_LV\Person;
use Illuminate\Support\Facades\DB;

class PersonCenterController extends Controller {

    public function index() {
        $data = array();
        switch (AuthController::getType()) {
            case 1:
                $resume = new ResumeController();
                $data['type'] = 1;
                $data['ResumeList'] = $resume->getResumeList();
                $info = new InfoController();
                $data['personInfo'] = $info->getPersonInfo();
                $data['recommendPosition'] = $this->recommendPosition();
                $data['messageNum'] = $this->getMessageNum();
                $data['deliveredNum'] = $this->getDeliveredNum();
                break;
            case 2:
                $data['type'] = 2;
                $info = new InfoController();
                $data['enterpriseInfo'] = $info->getEnprInfo();
                $data['positionList'] = $this->getPostionList();
                $data['messageNum'] = $this->getMessageNum();
                $data['applyList'] = $this->getApplyList();
                break;
        }

        return view('account.index', ['data' => $data]);
    }

    public function recommendPosition() {

        $uid = AuthController::getUid();
        $intentions = DB::table('jobs_personinfo')->join('jobs_intention', 'jobs_personinfo.uid', '=', 'jobs_intetion.uid')
            ->where('uid', '=', $uid)
            ->select('sex', 'work_nature', 'occupation', 'industry', 'region', 'salary')
            ->get();
        $result = array();
        $education = Education::where('uid', '=', $uid)
            ->orderBy('degree', 'desc')
            ->first();//获取最高学历
        foreach ($intentions as $intention) {
            $result[] = Position::where('position_status', '=', 1)
                ->where('work_nature', '=', $intention['work_nature'])
                ->where('education', '<=', $education)
                ->orWhere('industry', '=', $intention['industry'])
                ->orWhere('occupation', '=', $intention['occupation'])
                ->get();
        }
        $result[] = Position::where('position_status', '=', 1)
            ->where('is_urgency', '=', 1)
            ->get();
        //需要让多维数组变成一维数组
        return $result;
    }

    public function getMessageNum() {
        $uid = AuthController::getUid();
        $num = Message::where('to_id', '=', $uid)
            ->where('is_read', '=', '0')
            ->count();
        if ($num > 99)
            return 99;
        else
            return $num;
    }

    //获取近30天的简历数目
    public function getDeliveredNum() {
        $uid = AuthController::getUid();
        $dateLimt = date("y-m-d h:i:s", strtotime('-30 day', time()));  //当前时间向前回退30天
//        echo $dateLimt;
        $num = Backup::where('uid', '=', $uid)
            ->where('created_at', '>', $dateLimt)
            ->count();
        return $num;
    }

    //获取简历列表
    public function getDeliveredList() {
        $uid = AuthController::getUid();
        $dateLimt = date("y-m-d h:i:s", strtotime('-30 day', time()));  //当前时间向前回退30天
        $result = Backup::where('uid', '=', $uid)
            ->where('created_at', '>', $dateLimt)
            ->select('did', 'eid', 'position_title', 'created_at')
            ->orderBy('created_at', 'desc')//根据创建时间进行排序
            ->get();
        //通过遍历对每一条记录进行状态查询
        foreach ($result as $delivered) {
            $delivered['enterpriseName'] = Enprinfo::where('eid', '=', $delivered['eid'])
                ->select('ename')
                ->get();
            $delivered['enterpriseName'] = $delivered['enterpriseName'][0]['ename'];
            $delivered['status'] = Delivered::where('did', '=', $delivered['did'])
                ->select('status', 'pid')
                ->get();
            $pid = $delivered['status'][0]['pid'];
            $delivered['status'] = $delivered['status'][0]['status'];
            if ($delivered['status'] == 0 || $delivered['status'] == 1) {
                $position_status = Position::where('pid', '=', $pid)
                    ->select('position_status')
                    ->get();
                $position_status = $position_status[0]['position_status'];
                if ($position_status != 1)  //若果职位状态非正常，则将投递状态改为失效，并对数据库进行操作
                {
                    $delivered['status'] = 4;
                    $update = Delivered::where('did', '=', $delivered['did'])->get();
                    $update->status = 4;
                    $update->save();
                }
            }
        }
        return $result;
    }

    public function getPostionList() {
        $uid = AuthController::getUid();
        $eid = Enprinfo::where('uid', '=', $uid)
            ->get();
        $eid = $eid[0]['eid'];
        $result = Position::where('eid', '=', $eid)
            ->where('position_status', '=', 1)
            ->select('title', 'describe')
            ->get();
        return $result;
    }

    //申请记录列表只包含未查看的简历
    public function getApplyList() {
        $uid = AuthController::getUid();
        $eid = Enprinfo::where('uid', '=', $uid)
            ->select('eid')
            ->get();
        $eid = $eid[0]['eid'];
        $pidArray = Position::where('eid', '=', $eid)
            ->where('postion_status', '=', 1)
            ->select('pid')
            ->get();
        $result = array();
        foreach ($pidArray as $value) {
            $didArray = Delivered::where('pid', '=', $value['pid'])
                ->where('status', '=', 0)
                ->select('did')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach ($didArray as $backup) {
                $temp = Backup::where('did', '=', $backup['did'])
                    ->select('position_title', 'created_at')
                    ->get();
                $result[] = $temp[0];
            }
        }
        return $result;
    }

    //查看所有
    public function getAllApplyList() {
        $uid = AuthController::getUid();
        $dateLimt = date("y-m-d h:i:s", strtotime('-30 day', time()));  //当前时间向前回退30天
        $eid = Enprinfo::where('uid', '=', $uid)
            ->select('eid')
            ->get();
        $eid = $eid[0]['eid'];
        $pidArray = Position::where('eid', '=', $eid)
            ->where('postion_status', '=', 1)
            ->select('pid')
            ->get();
        $result = array();
        foreach ($pidArray as $value) {
            $didArray = Delivered::where('pid', '=', $value['pid'])
                ->select('did')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach ($didArray as $backup) {
                $temp = Backup::where('did', '=', $backup['did'])
                    ->where('created_at', '>', $dateLimt)//最多显示30天以内的
                    ->select('position_title', 'created_at')
                    ->get();
                $result[] = $temp[0];
            }
        }
        return $result;
    }

    //查看简历的方法
    public function getResumeDetail($did) {
        //1.将状态设置为已查阅
        $deid = Delivered::where('did', '=', $did)
            ->select('deid')
            ->get();
        $deid = $deid[0]['$deid'];
        $delivered = Delivered::find($deid);
        $delivered->status = 1;
        $delivered->save();
        //2.准备好简历详细信息
        $backup = Backup::where('did', '=', $did)
            ->get();
        $personInfo = Person::where('uid', '=', $backup[0]['uid'])
            ->get();
        $result['backup'] = $backup[0];
        $result['personInfo'] = $personInfo;
        //3.发送站内信
        $position_title = $backup[0]['position_title'];
        $uid = AuthController::getUid();
        $enterpriseName = Enprinfo::where('uid', '=', $uid)
            ->select('ename')
            ->get();
        $enterpriseName = $enterpriseName[0]['ename'];
        $message = new Message();
        $message->to_id = $backup[0]['uid'];
        $message->from_id = $uid;
        $message->content = "您投递的" . $enterpriseName . $position_title . "的简历已被公司查阅";
        $message->save();
        return $result;
    }
}
