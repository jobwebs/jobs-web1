<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Enprinfo;
use App\Http\Controllers\Controller;
use App\position;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class PositionController extends Controller
{
    public function applyList ()
    {
        return view('position/applyList');
    }
    public function publish (Request $request,$options)
    {

        if($options =="add"){
            //$position = Position::all();
            //可以使用批量赋值方法creat()
            if ($request->isMethod('POST')) {
                //还未验证字段合法性
                $data = $request->input(position);
                $position = new position();
                $position->eid = 1;//从注册session中获得
                $position->title = $data['title'];
                $position->tag = $data['tag'];
                $position->describe = $data['describe'];
                $position->salary = $data['salary'];
                $position->region = $data['region'];
                $position->work_nature = $data['work_nature'];
                $position->occupation = $data['occupation'];
                $position->industry = $data['industry'];
                $position->experience = $data['experience'];
                $position->education = $data['education'];
                $position->total_num = $data['total_num'];
                $position->max_age = $data['max_age'];
                $position->vaildity = $data['vaildity'];
                $position->position_status = $data['position_status'];

                if ($position->save()) {
                    publishList();//如果插入成功则跳转到职位列表页面。
                } else {
                    return redirect()->back();//失败返回上一个请求页面。

                }
            }
        }else if($options =="index"){
            return view('position/publish');
        }

    }
    public function test1 (Request $request){
        $request->session()->put('uid',1);
    }
    public function publishList (Request $request,$options)
    {
        $uid = $request->session()->get('uid');
        //$uid = $request->input('uid');//可以从session中获得
        $eid = Enprinfo::select('eid')
            ->where('uid','=',$uid)
            ->get();
        //echo $eid;
        if($options == "list") {
            $position = Position::select('pid', 'title', 'tag', 'salary', 'region', 'work_nature', 'total_num')
                ->where('eid', '=', $eid[0]['eid'])
                ->orderBy('pid', 'desc')
                ->get();
            return $position;
        }else if ($options =="delete"){
            $pid = $request->input('pid');
            $position = Position::find($pid);
            $bool = $position->delete();
            return $bool;//删除成功或者失败
            //return "delete";
        }
        return view('position/publishList');
    }
    public function detail (Request $request)
    {//根据pid号返回职位信息
        if($request->has('pid')) {
            $pid = $request->input('pid');//获取前台传来的pid
            $position = Position::find($pid);
            dd($position);
        }
        //return view('position/detail');
    }
    public function edit ()//职位修改页面
    {
        if($request->has('position')) {//验证前台是否有传值
            $data = $request->input('position');
            $pid = $data['pid'];//获取前台传来的pid
            $position = Position::find($pid);
            $position->title = $data['title'];
            $position->tag = $data['tag'];
            $position->describe = $data['describe'];
            $position->salary = $data['salary'];
            $position->region = $data['region'];
            $position->work_nature = $data['work_nature'];
            $position->occupation = $data['occupation'];
            $position->industry = $data['industry'];
            $position->experience = $data['experience'];
            $position->education = $data['education'];
            $position->total_num = $data['total_num'];
            $position->max_age = $data['max_age'];
            $position->vaildity = $data['vaildity'];
            $position->position_status = $data['position_status'];
            $position->save();
            return redirect()->back()->with('success','更新成功');
        }
    }
    public function advanceSearch ()
    {
        return view('position/advanceSearch');
    }
}