<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Console\Helper\Table;

class OccupationController extends Controller
{
    //显示已添加职业
    public function index ()
    {
        $data = array();
        $data['occupation'] = Occupation::all();
        return $data;
    }
    //删除、添加职业
    //添加传入occupation[name,industry_id],删除传入oid
    public function edit(Request $request,$option){
        switch ($option){
            case 'add':
                //return 'add';
                if($request->has('occupation')){
                    $data = $request->input('occupation');
                    //$data['name']="智享互联";
                    $occupation = new Occupation();
                    $occupation->name = $data['name'];
                    $occupation->industry_id = $data['industry_id'];

                    if($occupation->save()){
                        return redirect('admin/occupation')->with('success',"添加成功");
                    }
                    return redirect('admin/occupation')->with('error',"添加失败");
                }
                break;
            case 'delete':
                //return 'delete';
                if($request->has('oid')){
                    $data = $request->input('oid');

                        $del = Occupation::find($data);
                        $bool = $del->delete();

                    if($bool){
                        return redirect('admin/occupation')->with('success',"删除成功");
                    }
                    return redirect('admin/occupation')->with('error',"删除失败");
                }
                break;
            default:
                return redirect('admin/occupation')->with('error',"删除失败");

        }
    }
}