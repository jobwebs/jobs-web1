<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Industry;
use App\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Console\Helper\Table;

class OccupationController extends Controller
{
    public function __construct()
    {
        $uid = AdminAuthController::getUid();
        if($uid == 0){
            return redirect('admin/login');
        }
    }
    //显示已添加职业
    public function index ()
    {
        $data = array();
        $data['occupation'] = Occupation::all();
        return $data;
    }
    public function edit(){
        $data = array();
        $data['industry'] = Industry::all();
        return $data;
    }
    //删除、添加职业
    //添加传入occupation[name,industry_id],删除传入oid
    public function Postedit(Request $request,$option){
        $data = array();
        switch ($option){
            case 'add':
                //return 'add';
                if($request->has('occupation')){
                    $name = $request->input('occupation');
                    $industry_id = $request->input('industry_id');
                    //$data['name']="智享互联";
                    $occupation = new Occupation();
                    $occupation->name = $name;
                    $occupation->industry_id = $industry_id;

                    if($occupation->save()){
                        $data['status'] = 200;
                        $data['msg'] = "添加成功";
                        return $data;
//                        return redirect('admin/occupation')->with('success',"添加成功");
                    }
                    $data['status'] = 400;
                    $data['msg'] = "添加失败";
                    return $data;
//                    return redirect('admin/occupation')->with('error',"添加失败");
                }
                break;
            case 'delete':
                //return 'delete';
                if($request->has('oid')){
                    $oid = $request->input('oid');

                        $del = Occupation::find($oid);
                        $bool = $del->delete();

                    if($bool){
                        $data['status'] = 200;
                        $data['msg'] = "删除成功";
                        return $data;
//                        return redirect('admin/occupation')->with('success',"删除成功");
                    }
                    $data['status'] = 400;
                    $data['msg'] = "删除失败";
                    return $data;
//                    return redirect('admin/occupation')->with('error',"删除失败");
                }
                break;
            default:
                $data['status'] = 400;
                $data['msg'] = "操作命令未知";
                return $data;
//                return redirect('admin/occupation')->with('error',"删除失败");

        }
        $data['status'] = 400;
        $data['msg'] = "删除失败";
        return $data;
    }
}