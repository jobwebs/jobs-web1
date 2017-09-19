<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Education;
use App\Industry;
use App\Intention;
use App\Occupation;
use App\Region;
use App\Resumes;
use Illuminate\Http\Request;

class ResumeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }


    // 返回添加简历页面的基本信息
    // 同时设置intention 表
    public function addResume() {
        $data = array();

        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if($type == 1 ){
            $resume = new Resumes();
            $resume->uid = $uid;
            $resume->resume_name = "未命名简历";
            $count = Resumes::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
            if ($count > 2) {
                $data['status'] = 400;
                $data['msg'] = "简历数大于上限";
            } else {
                $resume->save();
                $intention = new Intention();
                $intention->rid = $resume->rid;
                $intention->uid = $uid;
                $intention->work_nature = -1;
                $intention->occupation = -1;
                $intention->industry = -1;
                $intention->region = -1;
                $intention->salary = -1;
                $intention->save();

                $data['status'] = 200;
                $data['rid'] = $resume->rid;
            }
        }else{
            $data['status'] = 400;
            $data['msg'] = "仅个人用户才能添加简历";
        }

        return $data;
    }

    public function getIndex(Request $request) {
        $input = $request->all();
        $data = array();

        $data['uid'] = AuthController::getUid();

        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        if (!($request->has('rid'))) return redirect()->back();

        $resume = Resumes::where('rid', $input['rid'])->get();

        if (sizeof($resume) == 0) return redirect()->back();

        if ($resume[0]->uid != $data['uid']) return redirect()->back();

        $data['rid'] = $input['rid'];
        $data['resume'] = Resumes::find($data['rid']);
        $data['intention'] = Intention::find($data['resume']['inid']);

        $skillStr = $data['resume']['skill'];
        if ($skillStr == null) {
            $data['resume']['skill'] = null;
        } else {
            $data['resume']['skill'] = explode("|@|", substr($skillStr, 3));
        }

        $data['education'] = $this->getEducation();
        $person = new InfoController();
        $data['personInfo'] = $person->getPersonInfo();
        $data['region'] = Region::all();
        $data['industry'] = Industry::all();
        $data['occupation'] = Occupation::all();

        //return $data;
        return view('resume/add', ["data" => $data]);
    }

    /**
     * 修改简历名称
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function rename(Request $request) {
        if (!($request->has('rid'))) {
            return redirect()->back()->with('error', '参数错误');
        }

        $input = $request->all();
        $rid = $input['rid'];

        $resume = Resumes::find($rid);

        $resume->resume_name = $input['name'];

        $data = array();
        if ($resume->save()) {
            $data['resume_name'] = $resume->resume_name;
            $data['status'] = 200;
        } else {
            $data['msg'] = "简历名称修改失败";
            $data['status'] = 400;
        }

        return $data;
    }

    /*简历列表
    */
    public function getResumeList() {
        $uid = AuthController::getUid();
        $result = Resumes::where('uid', '=', $uid)
            ->select('rid', 'inid', 'resume_name')
            ->get();
        return $result;
    }

    //预览简历
    public function previewResume(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['type'] = AuthController::getType();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $input = $request->all();
        if (!($request->has('rid'))) {
            return redirect()->back() - with('error', '参数错误');
        }

        $data['rid'] = $input['rid'];

        $person = new InfoController();
        $data['personInfo'] = $person->getPersonInfo();
        $data['resume'] = Resumes::find($data['rid']);
        $data['intention'] = Intention::find($data['resume']['inid']);
        $data['education'] = $this->getEducation();

        $skillStr = $data['resume']['skill'];
        if ($skillStr == null) {
            $data['resume']['skill'] = null;
        } else {
            $data['resume']['skill'] = explode("|@|", substr($skillStr, 3));
        }

        $data['region'] = Region::all();
        $data['industry'] = Industry::all();
        $data['occupation'] = Occupation::all();

        //return $data;
        return view('resume/preview', ["data" => $data]);
    }

    //基本信息的获取
//    public function generateRid() {
//        $uid = AuthController::getUid();
//        $resume = new Resumes();
//        $resume->uid = $uid;
//        $nums = Resumes::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
//        if ($nums > 2)
//            return "简历数大于上限";           //进行简历数的一个判断
//        else {
//            $resume->save();                //save()之后$resume就是一个返回的东西!!!
//            $rid = $resume->rid;           //插入成功之后返回主键
//            return $rid;
//        }
//    }

//    public function getRegion() {
//        $region = Region::select('id', 'name', 'parent_id')->get();
//        return $region;
//    }
//
//    public function getIndustry() {
//        $industry = Industry::select('id', 'name')->get();
//        return $industry;
//    }


    /**
     * 添加/修改求职意向
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function addIntention(Request $request) {
        $input = $request->all();
        $rid = $input['rid'];

        $result = Intention::where('rid', '=', $rid)->get();
        if ($result->isEmpty()) {
            $intention = new Intention();
            $intention->uid = AuthController::getUid();

            $intention->rid = $rid;
            $intention->work_nature = $input['work_nature'];
            $intention->occupation = $input['occupation'];
            $intention->industry = $input['industry'];
            $intention->region = $input['region'];
            $intention->salary = $input['salary'];
        } else {                      //执行更新操作
            $inid = Intention::where('rid', '=', $rid)
                ->select('inid')
                ->get();
            $inid = $inid[0]['inid'];
            $intention = Intention::find($inid);
            $intention->work_nature = $input['work_nature'];
            $intention->occupation = $input['occupation'];
            $intention->industry = $input['industry'];
            $intention->region = $input['region'];
            $intention->salary = $input['salary'];
        }

        $data = array();
        if ($intention->save()) {
            $resume = Resumes::find($rid);
            $resume->inid = $intention->inid;
            if ($resume->save()) {
                $data['status'] = 200;
                $data['intention'] = $intention;
            } else {
                $data['status'] = 400;
                $data['msg'] = '简历更新失败';
            }
        } else {
            $data['status'] = 400;
            $data['msg'] = '求职意向添加／更新失败';
        }

        return $data;
    }

    //最多写出最高的三个教育经历，依次从高到底填写；最少写出一个教育经历
    public function addEducation(Request $request) {
        $uid = AuthController::getUid();

        $data = array();
        $count = Education::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
        if ($count > 2) {
            $data['status'] = 400;
            $data['msg'] = "最多添加3个教育经历";
        } else {
            $input = $request->all();
            $education = new Education();
            $education->uid = $uid;
            $education->school = $input['school'];
            $education->date = $input['date'];
            $education->major = $input['major'];
            $education->degree = $input['degree'];

            if ($education->save()) {
                $data['status'] = 200;
                $data['education'] = $education;
            } else {
                $data['status'] = 400;
                $data['msg'] = "添加教育经历失败";
            }
        }
        return $data;
    }

    public function getEducation() {
        return Education::where('uid', '=', AuthController::getUid())->get();
    }


    public function deleteEducation(Request $request) {
        $data = array();
        if (Education::find($request->input('eduid'))->delete()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
        }

        return $data;
    }

//    public function updateEducation(Request $request) {
//        $input = $request->all();
//        $uid = AuthController::getUid();
//        $eduid = $input['eduid'];
//        $education = Education::find($eduid);
//        $education->uid = $uid;
//        $education->school = $input['school'];
//        $education->date = $input['date'];
//        $education->major = $input['major'];
//        $education->degree = $input['degree'];
//        if ($education->save()) {
//            return $education;
//        } else {
//            return "操作数据库失败";
//        }
//    }

    //添加技能
    public function addTag(Request $request) {
        $input = $request->all();
        $rid = $input['rid'];
        $tag = $input['skill'] . '|' . $input['level'];
        $skill = Resumes::where('rid', '=', $rid)
            ->select('skill')
            ->get();

        $data = array();

        $skill = $skill[0]['skill'];
        if ($skill == '[]') {
            $skill = '|@|' . $tag;
        } else {
            $skill = $skill . '|@|' . $tag;
        }

        $resume = Resumes::find($rid);
        $resume->skill = $skill;
        if ($resume->save()) {
            $data['status'] = 200;
            $data['skill'] = $resume->skill;
        } else {
            $data['status'] = 400;
            $data['msg'] = "新增技能特长失败";
        }

        return $data;
    }

    public function deleteTag(Request $request) {
        $data = array();

        $input = $request->all();
        $rid = $input['rid'];
        $string = $input['tag'];
        $skill = Resumes::where('rid', '=', $rid)
            ->select('skill')
            ->get();
        $skill = $skill[0]['skill'];

        $string = '|@|' . $string;
        $skill = str_replace($string, "", $skill);
        $resume = Resumes::find($rid);
        $resume->skill = $skill;
        if ($resume->save()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
        }

        return $data;
    }

    //添加额外信息
    public function addExtra(Request $request) {
        $input = $request->all();
        $rid = $input['rid'];
        $resume = Resumes::find($rid);
        $resume->extra = $input['extra'];
        $data = array();
        if ($resume->save()) {
            $data['status'] = 200;
            $data['extra'] = $resume->extra;
        } else {
            $data['status'] = 400;
            $data['msg'] = "附加内容添加失败";
        }

        return $data;
    }
}
