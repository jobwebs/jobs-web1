<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/6
 * Time: 19:45
 */

namespace App\Http\Controllers;
use App\http\Controllers\AuthController;
use App\personinfo;
use App\enprinfo;
use Illuminate\Http\Request;
class InfoController extends Controller
{

    public function getPersonInfo()
    {
        $auth = new AuthController();
        $uid = $auth->getUid();
        $type = $auth->getType();
        if($uid && $type == 1)   //确认为合法个人用户
        {
            $personInfo =PersonInfo::where('uid','=',$uid)
                ->get();
            return $personInfo;
        }
    }
    public function getEnprInfo()
    {
        $auth = new AuthController();
        $uid = $auth->getUid();
        $type = $auth->getType();
        if($uid && $type == 2)   //确认为合法企业用户
        {
            $enprInfo =Enprinfo::where('uid','=',$uid)
                ->get();
            return $enprInfo;
        }
    }
    public function editPersonInfo(Request $request)
    {
        //验证前台是否有传值 这个地方还没做
        $input = $request->all();
        $auth = new AuthController();
        $uid = $auth->getUid();
        $type = $auth->getType();
        if($uid && $type == 1)   //确认为合法个人用户
        {
            $pid = PersonInfo::where('uid','=',$uid)
                ->select('pid')
                ->get();
            //如果存在pid则为修改信息执行更新操作，反之则为新增执行插入操作
            if($pid != '[]')                //更改信息$pid->isEmpty();
            {
                $pid = $pid[0]['pid'];
                $personInfo = PersonInfo::find($pid);
                $personInfo->pname = $input['pname'];
                //photo没有完成上传 之后完成
                $personInfo->birthday = $input['birthday'];
                $personInfo->sex = $input['sex'];
                $personInfo->register_way = $input['register_way'];
                $personInfo->work_year = $input['work_year'];
                $personInfo->register_place = $input['register_place'];
                $personInfo->residence = $input['residence'];
                $personInfo->tel = $input['tel'];
                $personInfo->is_marry = $input['is_marry'];
                $personInfo->political = $input['political'];
                $personInfo->self_evalu = $input['self_evalu'];
                $personInfo->education = $input['education'];
                if ($personInfo->save()) {
                    return redirect('account/getPersonInfo')->with('success','个人信息修改成功');
                } else {
                    return redirect('account/getPersonInfo')->with('error','个人信息修改失败');
                }
            } else{                  //新增信息
                $personInfo = new PersonInfo();
                $personInfo->uid = $uid;
                $personInfo->pname = $input['pname'];
                //photo没有完成上传 之后完成
                $personInfo->birthday = $input['birthday'];
                $personInfo->sex = $input['sex'];
                $personInfo->register_way = $input['register_way'];
                $personInfo->work_year = $input['work_year'];
                $personInfo->register_place = $input['register_place'];
                $personInfo->residence = $input['residence'];
                $personInfo->tel = $input['tel'];
                $personInfo->is_marry = $input['is_marry'];
                $personInfo->political = $input['political'];
                $personInfo->self_evalu = $input['self_evalu'];
                $personInfo->education = $input['education'];
                if ($personInfo->save()) {
                    return redirect('account/getPersonInfo')->with('success','个人信息添加成功');
                } else {
                    return redirect('account/getPersonInfo')->with('error','个人信息添加失败');
                }
            }
        }

    }
    public function editEnprInfo(Request $request)
    {
        //todo 上传照片还没有做
        $input = $request->all();
        $auth = new AuthController();
        $uid = $auth->getUid();
        $type = $auth->getType();
        if($uid && $type == 2)   //确认为合法企业用户
        {
            $eid = Enprinfo::where('uid','=',$uid)
                ->select('eid')
                ->get();
            //如果存在pid则为修改信息执行更新操作，反之则为新增执行插入操作
            if($eid != '[]')                //更改信息
            {
                $eid = $eid[0]['eid'];
                $enprInfo = Enprinfo::find($eid);    //根据主键进行查询
                $enprInfo->ename = $input['ename'];
                $enprInfo->email = $input['email'];
                $enprInfo->etel = $input['etel'];
                $enprInfo->ebrief = $input['ebrief'];
                $enprInfo->escale = $input['escale'];
                $enprInfo->enature = $input['enature'];
                $enprInfo->industry = $input['industry'];
                $enprInfo->home_page = $input['home_page'];
                $enprInfo->address = $input['address'];
                $enprInfo->ecertifi = $input['ecertifi'];
                $enprInfo->lcertifi = $input['lcertifi'];
                $enprInfo->is_verification = $input['is_verification'];
                if ($enprInfo->save()) {
                    return redirect('account/getEnprInfo')->with('success','企业信息修改成功');
                } else {
                    return redirect('account/getEnprInfo')->with('error','企业信息修改失败');
                }
            }else{
                $enprInfo = new Enprinfo();
                $enprInfo->uid = $uid;
                $enprInfo->ename = $input['ename'];
                $enprInfo->email = $input['email'];
                $enprInfo->etel = $input['etel'];
                $enprInfo->ebrief = $input['ebrief'];
                $enprInfo->escale = $input['escale'];
                $enprInfo->enature = $input['enature'];
                $enprInfo->industry = $input['industry'];
                $enprInfo->home_page = $input['home_page'];
                $enprInfo->address = $input['address'];
                $enprInfo->ecertifi = $input['ecertifi'];
                $enprInfo->lcertifi = $input['lcertifi'];
                $enprInfo->is_verification = $input['is_verification'];
                if ($enprInfo->save()) {
                    return redirect('account/getEnprInfo')->with('success','企业信息添加成功');
                } else {
                    return redirect('account/getEnprInfo')->with('error','企业信息添加失败');
                }
            }
        }
    }
}