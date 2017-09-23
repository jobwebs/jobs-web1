<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Console\Helper\Table;

class RegionController extends Controller
{
    //显示已添加地区
    public function index ()
    {
        $data = array();
        $uid = AdminAuthController::getUid();
        if($uid == 0){
            return redirect('admin/login');
        }
        $data['region'] = Region::all();
//        return $data;
        return view('admin/region',['data'=>$data]);
    }
    //删除、添加行业
    //添加传入region[name],删除传入rid
    public function edit(Request $request,$option){
        $uid = AdminAuthController::getUid();
        if($uid == 0){
            return redirect('admin/login');
        }
        switch ($option){
            case 'add':
                //return 'add';
                if($request->has('region')){
                    $data = $request->input('region');

                    $region = new Region();
                    $region->name = $data['name'];

                    if($region->save()){
                        return redirect('admin/region')->with('success',"添加成功");
                    }
                    return redirect('admin/region')->with('error',"添加失败");
                }
                break;
            case 'delete':
                //return 'delete';
                if($request->has('rid')){
                    $data = $request->input('rid');

                        $del = Region::find($data);
                        $bool = $del->delete();

                    if($bool){
                        return redirect('admin/region')->with('success',"删除成功");
                    }
                    return redirect('admin/region')->with('error',"删除失败");
                }
                break;
            default:
                return redirect('admin/region')->with('error',"删除失败");

        }
    }
}