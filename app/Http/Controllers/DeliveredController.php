<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Delivered;
use App\Backup;
use App\Position;
use App\Resumes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DeliveredController extends Controller
{
    public function index ()
    {

    }
    //投递简历函数。
    //back_up表、delivered表
    //传递简历id+职位id
    //发送站内信到企业id
    public function delivered(Request $request)
    {
        $uid = AuthController::getUid();
        if($uid == 0){
            return view('account.register');
        }
        if($request->has('rid') && $request->has('pid')){//传入职位id 和简历id
            echo 1;
            $rid = $request->input('rid');
            $pid = $request->input('pid');

            //查询简历表信息
            $resumeinfo = Resumes::find($rid);
            $positioninfo = Position::find($pid);
            if(empty($resumeinfo)||empty($positioninfo)){
                return redirect()->back()->with('error','简历投递失败');
            }
            return $positioninfo;
            //新建back_up表，保存投递信息
            $back_up = new Backup();
            $back_up->uid = $uid;
            $back_up->eid = $uid;

            //新建投递表
            $deliver = new Delivered();
        }
    }
}
