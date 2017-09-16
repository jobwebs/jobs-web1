<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Delivered;
use App\Enprinfo;
use App\Industry;
use App\Occupation;
use App\Position;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller {
    public function applyList() {
        return view('position/applyList');
    }
    //发布职位首页.
    //返回职位发布页中所需数据
    public function publishIndex() {
        $uid = AuthController::getUid();
        if ($uid == 0) {
            return view('account.login');
        }
        $data = array();
        //查询工作地区
        $data['region'] = Region::all();
        //查询职业
        $data['occupation'] = Occupation::all();
        //查询行业
        $data['industry'] = Industry::all();
        //return $data;
        return view('position/publish', ['data' => $data]);
    }

    //发布职位，添加数据库，返回执行结果
    public function publish(Request $request) {
        //$position = Position::all();
        //可以使用批量赋值方法creat()
        $uid = AuthController::getUid();
        if ($uid == 0) {
            return view('account.login')->with('error', '请登录后操作');
        }
        if ($request->isMethod('POST')) {
            //还未验证字段合法性
            $data = $request->input(position);
            $position = new position();
            $position->eid = 1;//从注册session中获得
            $position->title = $data['title'];
            $position->tag = $data['tag'];
            $position->describe = $data['describe'];
            $position->salary = $data['salary'];
            $position->region = $data['region'];//工作地区，这里应为地区id，指向jobs_region
            $position->work_nature = $data['work_nature'];//工作性质（兼职|实习|全职）int
            $position->occupation = $data['occupation'];//职业，这里应为职业id，指向jobs_occupation
            $position->industry = $data['industry'];//行业，这里应为行业id，指向jobs_industry
            $position->experience = $data['experience'];//
            $position->education = $data['education'];
            $position->total_num = $data['total_num'];
            $position->max_age = $data['max_age'];
            $position->vaildity = $data['vaildity'];

            if ($position->save()) {
                //PositionController::publishList();//如果插入成功则跳转到职位列表页面。
                return redirect('position/publish')->with('success', '职位发布成功');
            } else {
                return redirect('position/publish')->with('error', '职位发布失败');//失败返回上一个请求页面。

            }
        }
    }
    //查询企业已发布职位信息
    //返回值，$data['position']--职位列表
    //$data['dcount']--每个职位所对应的已投递次数
    //查看已发布职位前，先查看其有效时间，时间过期则更新状态。
    public function publishList(Request $request) {
        $data = array();
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return view('account.login')->with('error', '请登录后操作');
        }
        //$uid = $request->input('uid');//可以从session中获得
        $eid = Enprinfo::select('eid')
            ->where('uid', '=', $uid)
            ->get();
//        echo $eid;
        //更新职位时间状态
        $temp = Position::select('pid')
            ->where('eid', '=', $eid[0]['eid'])
            ->where('vaildity', '<', date('Y-m-d H-i-s'))
            ->where('position_status', '=', 1)
            ->get();
        foreach ($temp as $item) {
            $temp_pos = Position::find($item['pid']);
            $temp_pos->position_status = 3;
            $temp_pos->save();
        }


        $data['position'] = Position::where('eid', '=', $eid[0]['eid'])
            ->where('position_status', '!=', 3)
            //select('pid', 'title', 'tag', 'salary', 'region', 'work_nature', 'total_num')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        //查询每一个职位对应的投递次数

        //获取每一个职位对应的pid，查询其被投递次数
        $dcount = array();
        foreach ($data['position'] as $item) {
            // var_dump($item['attributes']['pid']);
            $pid = $item['attributes']['pid'];
            $dcount[$pid] = Delivered::where('pid', '=', $pid)
                ->count();
        }
        $data['dcount'] = $dcount;

        return view('position.publishlist', ['data' => $data]);
        //return $position;
    }

    //在职位发布列表搜索已发布的职位
    public function searchPosition(Request $request) {
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return view('account.login')->with('error', '请登录后操作');
        }
        $data = array();
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
        } else
            $keyword = "";
        $eid = Enprinfo::select('eid')
            ->where('uid', '=', $uid)
            ->get();

        $data['position'] = Position::where('eid', '=', $eid[0]['eid'])
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere(function ($query) use ($keyword) {
                        $query->where('pdescribe', 'like', '%' . $keyword . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        //查询每一个职位对应的投递次数

        //获取每一个职位对应的pid，查询其被投递次数
        $dcount = array();
        foreach ($data['position'] as $item) {
            // var_dump($item['attributes']['pid']);
            $pid = $item['attributes']['pid'];
            $dcount[$pid] = Delivered::where('pid', '=', $pid)
                ->count();
        }
        $data['dcount'] = $dcount;

        return view('position.publishlist', ['data' => $data]);
    }

    //删除已发布职位
    public function delPosition(Request $request) {
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return view('account.login')->with('error', '请登录后操作');
        }
        $pid = $request->input('pid');
        $position = Position::find($pid);
        if ($position) {
            $bool = $position->delete();
            if ($bool) {
                return view('position/publishList')->with('sucess', '删除成功');
            }
        }
        return view('position/publishList')->with('error', '删除失败');
    }
    //职位详情页面
    //返回值：data[detail]--职位基本详情
    //data[dcount]--职位被投递次数
    //data[enprinfo]--公司基本信息
    //data[position]--公司其他职位
    //增加简历浏览次数
    public function detail(Request $request) {
        $data = array();
        //根据pid号返回职位信息
        if ($request->has('pid')) {
            $pid = $request->input('pid');//获取前台传来的pid
            $data['detail'] = Position::find($pid);
            $data['detail']->view_count += 1;
            $data['detail']->save();

            $data['dcount'] = Delivered::where('pid', '=', $pid)
                ->count();
            $eid = $data['detail']['attributes']['eid'];

            $data['enprinfo'] = Enprinfo::where('eid', '=', $eid)
                ->where('is_verification', '=', 1)
                ->get();
            $data['position'] = Position::where('eid', '=', $eid)
                ->where('pid', '!=', $pid)
                ->where('position_status', '=', 1)
                ->where('vaildity', '>=', date('Y-m-d H-i-s'))
                ->get();
        }
        //return $data;
        return view('position/detail', ["position" => $data]);
    }

    public function edit(Request $request)//职位修改页面
    {
        if ($request->has('position')) {//验证前台是否有传值
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
            if ($position->save()) {
                return redirect()->back()->with('success', '更新成功');
            }
        }
        return redirect()->back()->with('error', '更新失败');
    }

    //职位高级搜索|根据行业、地区、薪酬、类型信息查找对应的职位信息
    //其中，salary 1:<3k 2:3k>= & <5k 3:5k>= & <10k 4:10k>= & <15k 5:15k>= & <20k 6:20k>= & <25k 7:25k>= & <50k 8:>=50k
    public function advanceSearch(Request $request) {
        $data = array();
        //if($request->isMethod('POST'))
        $sql = "select *from jobs_position where vaildity >= " . "'" . date('Y-m-d H-i-s') . "'" . " and position_status = 1 ";
        if ($request->has('industry')) {//行业
//            $industry = "industry = " . $request->input('industry');
            $sql = $sql . " and industry = " . $request->input('industry');
        } else {
//            $industry = 1;
            $sql = $sql . " and 1";
        }
        if ($request->has('region')) {//工作地区
            $region = "region = " . $request->input('region');
            $sql = $sql . " and " . $region;
        } else {
//            $region = 1;
            $sql = $sql . " and 1";
        }
        if ($request->has('salary')) {//薪酬
            switch ($request->input('salary')) {
                case 1:
                    $salary = "salary < 3000";
                    $sql = $sql . " and " . $salary;
                    break;
                case 2:
                    $salary = "salary >=3000 and salary < 5000";
                    $sql = $sql . " and " . $salary;
                    break;
                case 3:
                    $salary = "salary >=5000 and salary < 10000";
                    $sql = $sql . " and " . $salary;
                    break;
                case 4:
                    $salary = "salary >=10000 and salary < 15000";
                    $sql = $sql . " and " . $salary;
                    break;
                case 5:
                    $salary = "salary >=15000 and salary < 20000";
                    $sql = $sql . " and " . $salary;
                    break;
                case 6:
                    $salary = "salary >=20000 and salary < 25000";
                    $sql = $sql . " and " . $salary;
                    break;
                case 7:
                    $salary = "salary >=25000 and salary < 50000";
                    $sql = $sql . " and " . $salary;
                    break;
                case 8:
                    $salary = "salary >= 50000";
                    $sql = $sql . " and " . $salary;
                    break;
                default:
                    $sql = $sql . " and 1";
            }

        } else {
//            $salary = 1;
            $sql = $sql . " and 1";
        }
        if ($request->has('work_nature')) {//工作类型 0兼职 1实习  2全职
            $work_nature = "work_nature = " . $request->input('work_nature');
            $sql = $sql . " and " . $work_nature;
        } else {
//            $work_nature = 1;
            $sql = $sql . " and 1";
        }
        if ($request->has('keyword')) {//职位名称描述搜索
            $keyword = $request->input('keyword');
//            $sql = $sql." and pdescribe like "."'%".$keyword."%'";
            $sql = $sql . " and CONCAT(title,pdescribe) LIKE " . "'%" . $keyword . "%'";
        } else {
//            $keyword = "";
            $sql = $sql . " and 1";
        }
//        $data['position'] = Position::whereRaw('? and ? and ? and ?', [$industry, $region, $salary, $work_nature])
//            ->where(function ($query) use ($keyword) {
//                $query->where('title', 'like', '%' . $keyword . '%')
//                    ->orWhere(function ($query) use ($keyword) {
//                        $query->where('describe', 'like', '%' . $keyword . '%');
//                    });
//            })
//            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
//            ->where('position_status', '=', 1)
//            ->get();
        $data['position'] = DB::select($sql);
        return $data;
        //return view('position/advanceSearch',['data' => $data]);
    }

    public function advanceIndex(Request $request) {
        $data = array();
        $data['industry'] = Industry::all();
        $data['region'] = Region::all();
        if ($request->has('industry')) {
            $data['position'] = Position::where('position_status', '=', 1)
                ->where('industry', '=', $request->input('industry'))
                ->where('vaildity', '>=', date('Y-m-d H-i-s'))
                ->paginate(12);
        } else {
            $data['position'] = Position::where('position_status', '=', 1)
                ->where('vaildity', '>=', date('Y-m-d H-i-s'))
                ->paginate(12);
        }

        return view('position/advanceSearch', ['data' => $data]);
    }

    public function test1(Request $request) {
        $request->session()->put('uid', 1);
    }

    /**
     * @return mixed
     */
    public function testRaw() {
        $data['position'] = DB::select("select * from jobs_position where CONCAT(title,pdescribe) LIKE '%业%'");
//        $data['position'] = Position::whereRaw("? and ? and ? and ?", array('industry=1',1,1,1))
//            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
//            ->where('position_status', '=', 1)
//            ->get();
        return $data;
    }
}
