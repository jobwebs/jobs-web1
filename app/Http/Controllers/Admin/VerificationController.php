<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Enprinfo;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class VerificationController extends Controller
{
    public function __construct()
    {
        $uid = AdminAuthController::getUid();
        if($uid == 0){
            return redirect('admin/login');
        }
    }
    //显示审核过或待审核的企业信息 option=2 审核失败 option=1 审核通过 option=0 未审核
    public function index (Request $request,$option=-1)
    {
        $data = array();
        switch ($option){
            case 0:
                $data['enprinfo'] = Enprinfo::where('is_verification','=',0)
                    ->where('ecertifi','!=','')
                    ->where('lcertifi','!=','')
                    ->orderBy('updated_at','desc')
                    ->paginate(10);//每页显示10条
                return $data;
                break;
            case 1:
                $data['enprinfo'] = Enprinfo::where('is_verification','=',1)
                    ->where('ecertifi','!=','')
                    ->where('lcertifi','!=','')
                    ->orderBy('updated_at','desc')
                    ->paginate(10);//每页显示10条
                return $data;
                break;
            case 2:
                $data['enprinfo'] = Enprinfo::where('is_verification','=',2)
                    ->where('ecertifi','!=','')
                    ->where('lcertifi','!=','')
                    ->orderBy('updated_at','desc')
                    ->paginate(10);//每页显示10条
                return $data;
                break;

        }
        //return $data;
        return view('admin/enterprise',['data'=>$data]);
    }
    //显示企业信息详情
    //传入企业eid、返回企业信息。
    public function showDetail(Request $request)
    {
        $data = array();
        if($request->has('eid')){
            $eid = $request->input('eid');

            $data['enprinfo'] = Enprinfo::find($eid);

        }
        return $data;
    }
    //审核通过函数
    //审核通过，修改数据库，并发布对应的审核消息到企业用户站内信。
    //传入参数enprinfo[‘eid’] ['states'] ['reason']
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passVerfi(Request $request)
    {
        $userid = AuthController::getUid();//验证接口返回
        $data = array();
        if($request->has('eid') && $request->has('status'))
        {
//            $data = $request->input('enprinfo');

//            $isPass = Enprinfo::find($data['eid']);
            $isPass = Enprinfo::find($request->input('eid'));
            if(empty($isPass)){
                $data['status'] = 400;
                $data['msg'] ="无此用户";
                return $data;
//                return redirect('admin/verification/')->with('error','无此用户');
            }
//            var_dump($isPass);
//            return 1;
            if($request->has('reason')){
                $reason = $request->input('reason');
            }else{
                $reason = "你的信息不符合要求";
            }
//            $data['reason']='123';
            switch ($request->input('status')){
                case '0'://审核拒绝
                    $isPass->is_verification = 2;//审核拒绝
                    $isPass->save();
                    //发送站内信
                    $content = "很抱歉！由于".$reason."您的企业信息审核未通过,尝试重新发布";
                    $mesage = new Message();
                    $mesage->from_id = $userid;
                    $mesage->to_id = $request->input('eid');
                    $mesage->content =$content;
                    if($mesage->save()){
                        $data['status'] = 200;
                        $data['msg'] ="操作成功";
                        return $data;
//                        return redirect('admin/verification/')->with('success','操作成功');
                    }
                    break;
                case '1': //审核通过
                    $isPass->is_verification = 1;//审核拒绝
                    $isPass->save();
                    //发送站内信
                    $content = "恭喜您！您的企业信息审核通过！";
                    $mesage = new Message();
                    $mesage->from_id = $userid;
                    $mesage->to_id = $request->input('eid');
                    $mesage->content =$content;
                    if($mesage->save()){
                        $data['status'] = 200;
                        $data['msg'] ="操作成功";
                        return $data;
//                        return redirect('admin/verification/')->with('success','操作成功');
                    }
                    break;
                default:
                    $data['status'] = 400;
                    $data['msg'] ="操作命令未知";
                    return $data;
            }
        }
        $data['status'] = 400;
        $data['msg'] ="操作失败";
        return $data;
//        return redirect('admin/verification/')->with('success','操作失败');
    }
}