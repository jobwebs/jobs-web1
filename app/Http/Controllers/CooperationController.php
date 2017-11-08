<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017-11-08
 * Time: 14:16
 */
namespace App\Http\Controllers;

use App\Cooperation;
use App\Enprinfo;
use App\News;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CooperationController extends Controller {
    //返回企业圈主页信息
    public function index(){
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $data['cooperation'] = Cooperation::where('validate','>=', date('Y-m-d H-i-s'))
            ->orderBy('created_at','desc')
            ->paginate(24);

        return $data;
    }
    public function publishCooperation(Request $request){
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        if ($data['uid'] == 0) {
            return redirect('admin/login');
        }
        if($data['type'] !=2){
            $data['status'] = 400;
            $data["msg"] = "企业用户才能发布合作信息";
            return $data;
        }
        $is_verification = Enprinfo::where('uid',$data['uid'])
            ->select('is_verification')
            ->first();
        if($is_verification['is_verification']!=1){
            $data['status'] = 400;
            $data["msg"] = "完成企业认证才能发布合作信息";
            return $data;
        }
        $sendcount = Cooperation::where('uid',$data['uid'])
            ->where('created_at','>=',date('Y-m-d H:i:s', strtotime('-1 day')))
            ->count();
        if($sendcount>=3){
            $data['status'] = 400;
            $data['msg'] = "一天最多发三条合作消息";
            return $data;
        }else{
            $coopreation =new Cooperation();
        }
        //接收参数
        $picture = $request->input('pictureIndex');
        $pictures = explode('@', $picture);
        if(count($pictures)>3){
            $data['status'] = 400;
            $data["msg"] = "最多上传三张图片";
            return $data;
        }
        $picfilepath = "";
        foreach ($pictures as $Item) {//对每一个照片进行操作。

            $pic = $request->file('pic' . $Item);//取得上传文件信息
            if ($pic->isValid()) {//判断文件是否上传成功
                //扩展名
                $ext1 = $pic->getClientOriginalExtension();
                //临时觉得路径
                $realPath = $pic->getRealPath();
                //生成文件名
                $picname = date('Y-m-d-H-i-s') . '-' . uniqid() . 'news' . $Item . '.' . $ext1;

                $picfilepath = $picfilepath . $Item . '@' . $picname . ';';
                $bool = Storage::disk('cooperpic')->put($picname, file_get_contents($realPath));
            }
        }
        //保存都数据库
        $coopreation->title = $request->input('title');
        $coopreation->uid = $data['uid'];//uid 后期通过登录注册方法获取
        $coopreation->city = $request->input('city');
        $coopreation->content = $request->input('content');
        $coopreation->picture = asset('storage/newspic/' . $picfilepath);
        $coopreation->validate = date('Y-m-d H:i:s', strtotime('+7 day'));
        if ($coopreation->save()) {
            $data['status'] = 200;
            $data['msg'] = "操作成功";
            return $data;
        } else {
            $data['status'] = 400;
            $data['msg'] = "操作失败";
            return $data;
        }
    }

}