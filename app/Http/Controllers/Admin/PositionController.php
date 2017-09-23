<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Console\Helper\Table;

class PositionController extends Controller
{
    public function __construct()
    {
        $uid = AdminAuthController::getUid();
        if($uid == 0){
            return redirect('admin/login');
        }
    }

    //显示已发布职位信息
    public function index (Request $request)
    {
        $data = array();
//        if($request->has('pagesize')){
//            $pagesize = $request->input('pagesize');
//        }else
//            $pagesize = 5;//默认每页显示20页

        $data['position'] = DB::table('jobs_position')
            ->join('jobs_enprinfo','jobs_position.eid','=','jobs_enprinfo.eid')
//            ->select()
            ->orderBy('updated_at','desc')
            ->paginate(20);

        return $data;
    }
    //根据企业名查询该企业发布的职位
    //传入企业名称
    public function findPosition(Request $request)
    {
        $data = array();
//        if($request->has('pagesize')){
//            $pagesize = $request->input('pagesize');
//        }else
//            $pagesize = 5;//默认每页显示20页
        if($request->has('ename')){
            $ename = $request->input('ename');
        }else
            $ename = '';

        $data['position'] = DB::table('jobs_position')
            ->join('jobs_enprinfo','jobs_position.eid','=','jobs_enprinfo.eid')
            ->where('ename', 'like', '%' . $ename . '%')
            ->paginate(20);

        return $data;
    }
    //设置职位是否急聘状态、传入pid
    public function isUrgency (Request $request)
    {
        if($request->has('pid')){
            $pid = $request->input('pid');
            $urgency = $request->input('urgency');

            $data = Position::find($pid);
            $data->is_urgency = (int)$urgency;

            if($data->save())
            {
                $data['status'] =200;
                $data['msg'] = "设置成功";
                return $data;
                //return redirect()->back()->with('success','设置成功');
            }
        }
        $data['status'] =400;
        $data['msg'] = "设置失败";
        return $data;
        //return redirect()->back()->with('error','设置失败');
    }
    //下架职位、传入pid
    public function OffPosition (Request $request)
    {
        if($request->has('pid')){
            $pid = $request->input('pid');

            $data = Position::find($pid);
            $data->position_status = 3;

            if($data->save())
            {
                $data['status'] =200;
                $data['msg'] = "设置成功";
                return $data;
                //return redirect()->back()->with('success','设置成功');
            }
        }
        $data['status'] =400;
        $data['msg'] = "设置失败";
        return $data;
        //return redirect()->back()->with('error','设置失败');
    }
}