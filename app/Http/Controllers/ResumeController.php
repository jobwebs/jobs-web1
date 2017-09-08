<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Education;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Helper\Table;
use App\http\Controllers\AuthController;
use App\Resumes;
use App\Region;
use App\Industry;
use App\Intention;

class ResumeController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    /*返回添加简历页面的基本信息
    *返回uid、type、rid、region、industry、education、personInfo等信息
    */
    public function getIndex()
    {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['type'] = AuthController::getType();
        $data['rid'] = $this->generateRid();
        $data['region'] = $this->getRegion();
        $data['industry'] = $this->getIndustry();
        $data['education'] = $this->getEducation();
        $person = new InfoController();
        $data['personInfo'] = $person->getPersonInfo();
        //dd($data);
        return  view('resume/add', ["data" => $data]);
    }
    public function generateRid()
    {
        $uid = AuthController::getUid();
        $resume = new Resumes();
        $resume->uid = $uid;
        $nums = Resumes::where('uid',$uid)->count();       //ORM聚合函数的用法
        if($nums>3)
            return "简历数大于上限";           //进行简历数的一个判断
        else{
            $resume->save();                //save()之后$resume就是一个返回的东西!!!
            $rid = $resume->rid;           //插入成功之后返回主键
            return $rid;
        }
    }
    public function getRegion()
    {
        $region = Region::select('id','name','parent_id')->get();
        return $region;
    }
    public function getIndustry()
    {
        $industry = Industry::select('id','name')->get();
        return $industry;
    }

    /*添加意向
    *添加意向成功后返回整条记录用于前台显示
    */
    public function addIntention(Request $request)
    {
        $input = $request->all();
        $rid = $input['rid'];
        //如果是改过一次，再次修改需要做一下小的修改
        $result = Intention::where('rid','=',$rid)
                ->get();
        if($result->isEmpty())    //执行插入操作
        {
            $intention = new Intention();
            $intention->rid = $rid;
            $intention->uid = $input['uid'];
            $intention->work_nature = $input['work_nature'];
            $intention->occupation = $input['occupation'];
            $intention->industry = $input['industry'];
            $intention->region = $input['region'];
            $intention->salary = $input['salary'];
        }else{                      //执行更新操作
            $inid =Intention::where('rid','=',$rid)
                ->select('inid')
                ->get();
            $inid = $inid[0]['inid'];
            $intention =Intention::find($inid) ;
            $intention->work_nature = $input['work_nature'];
            $intention->occupation = $input['occupation'];
            $intention->industry = $input['industry'];
            $intention->region = $input['region'];
            $intention->salary = $input['salary'];
        }
        if($intention->save())
        {
            $resume = Resumes::find($rid);
            $resume->inid = $intention->inid;
            $resume->save();
            return $intention;
        }else{
            return "操作数据库失败";
        }
    }
    //最多写出最高的三个教育经历，依次从高到底填写；最少写出一个教育经历
    public function addEducation(Request $request)
    {
        $uid = AuthController::getUid();
        $input = $request->all();
        $education = new Education();
        $education->uid = $uid;
        $education->school = $input['school'];
        $education->date = $input['date'];
        $education->major = $input['major'];
        $education->degree = $input['degree'];
        if($education->save())
        {
            return $education;
        }else{
            return "操作数据库失败";
        }
    }
    public function getEducation()
    {
        $uid = AuthController::getUid();
        $education = Education::where('uid','=',$uid)
                   ->get();
        return $education;
    }
    public function deleteEducation($eduid)
    {
        $education = Education::find($eduid);
        $bool = $education->delete();
        if($bool)
        {
            return "删除成功";
        }else{
            return "删除失败";
        }
    }
    public function updateEducation(Request $request)
    {
        $input = $request->all();
        $uid = AuthController::getUid();
        $eduid = $input['eduid'];
        $education = Education::find($eduid);
        $education->uid = $uid;
        $education->school = $input['school'];
        $education->date = $input['date'];
        $education->major = $input['major'];
        $education->degree = $input['degree'];
        if($education->save())
        {
            return $education;
        }else{
            return "操作数据库失败";
        }
    }
    //添加标签
    public function addTag(Request $request)
    {
        $input = $request->all();
        $rid = $input['rid'];
        $tag = $input['skill'];
        $tag = $tag.'|'.$input['level'];
        $skill = Resumes::where('rid','=','rid')
               ->select('skill')
               ->get();
        $skill = $skill[0]['skill'];
        $skill = $skill.'|@|'.$tag;          //利用|@|进行分割标记
        $resume =Resumes::find($rid);
        $resume->skill = $skill;
        $resume->save();
        return $resume->skill;
    }
    //添加额外信息
    public function addExrta(Request $request)
    {
        $input = $request->all();
        $rid = $input['rid'];
        $resume =Resumes::find($rid);
        $resume->extra = $input['extra'];
        if($resume->save())
        {
            return $resume->extra;
        }else{
            return "操作数据库失败";
        }

    }


//position/applyList

}