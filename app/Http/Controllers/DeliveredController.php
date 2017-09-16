<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Backup;
use App\Delivered;
use App\Education;
use App\Intention;
use App\Message;
use App\Occupation;
use App\Position;
use App\Region;
use App\Resumes;
use Illuminate\Http\Request;

class DeliveredController extends Controller {
    public function index() {

    }
    //投递简历函数。
    //back_up表、delivered表
    //传递简历id+职位id
    //发送站内信到企业id
    public function delivered(Request $request) {
        $uid = AuthController::getUid();
        if ($uid == 0) {
            return view('account.register');
        }

        $data = array();

        if ($request->has('rid') && $request->has('pid')) {//传入职位id 和简历id
            $rid = $request->input('rid');
            $pid = $request->input('pid');

            //查询简历表信息
            $resumeinfo = Resumes::find($rid);
            $intentioninfo = Intention::where('uid', '=', $uid)
                ->where('rid', '=', $rid)
                ->get();
            $positioninfo = Position::find($pid);

            //return $intentioninfo[0];

            //设置work_nature值:012 兼职 实习 全职
            if ($intentioninfo[0]['work_nature'] == 0) {
                $work_nature = "兼职";
            } else if ($intentioninfo[0]['work_nature'] == 1) {
                $work_nature = "实习";
            } else {
                $work_nature = "全职";
            }
            //设置occupation值
            $occupation = Occupation::find($intentioninfo[0]['occupation']);
            //设置region值
            $region = Region::find($intentioninfo[0]['region']);

            if (empty($resumeinfo) || empty($positioninfo)) {
                return redirect()->back()->with('error', '简历投递失败');
            }
            //设置教育经历
            $education = Education::where('uid', '=', $uid)
                ->get();

            //新建back_up表，保存投递信息
            $back_up = new Backup();
            $back_up->uid = $uid;
            $back_up->eid = $positioninfo['eid'];
            $back_up->position_title = $positioninfo['title'];
            $back_up->work_nature = $work_nature;
            $back_up->occupation = $occupation['name'];
            $back_up->region = $region['name'];
            $back_up->salary = $intentioninfo[0]['salary'];
            $back_up->skill = $resumeinfo['skill'];
            $back_up->extra = $resumeinfo['extra'];

            $tem = 0;
            foreach ($education as $item) {
                $tem += 1;
                //return $item;
                $education = $item['school'] . '@' . $item['date'] . '@' . $item['major'] . '@' . $item['degree'];
                switch ($tem) {
                    case 1:
                        $back_up->education1 = $education;
                        break;
                    case 2:
                        $back_up->education2 = $education;
                        break;
                    case 3:
                        $back_up->education3 = $education;
                        break;
                }
            }
            $back_up->save();
            //return $back_up;

            //新建投递表
            $deliver = new Delivered();
            $deliver->did = $back_up['did'];
            $deliver->pid = $pid;
            $deliver->status = 0;

            if ($deliver->save()) {
                //发送站内信到企业端
                if ($uid != 0) {
                    $message = new Message();
                    $message->from_id = $uid;
                    $message->to_id = $positioninfo['eid'];
                    $message->content = "这是我的简历，请注意查收！";
                    $message->save();
                }

                $data['status'] = 200;
            } else {
                $data['status'] = 400;
                $data['msg'] = "简历投递失败";
            }


        } else {
            $data['status'] = 400;
            $data['msg'] = "缺失参数";
        }

        return $data;
    }
}
