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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Console\Helper\Table;

class IndustryController extends Controller
{
    //显示已添加行业
    public function index ()
    {
        $data = array();
        $data['industry'] = Industry::all();
        return $data;
    }
    //删除、添加行业
    //添加传入industry[name],删除传入inid
    public function edit(Request $request,$option){
        switch ($option){
            case 'add':
                //return 'add';
                if($request->has('industry')){
                    $data = $request->input('industry');
                    //$data['name']="智享互联";
                    $industry = new Industry();
                    $industry->name = $data['name'];

                    if($industry->save()){
                        return redirect('admin/industry')->with('success',"添加成功");
                    }
                    return redirect('admin/industry')->with('error',"添加失败");
                }
                break;
            case 'delete':
                //return 'delete';
                if($request->has('inid')){
                    $data = $request->input('inid');

                        $del = Industry::find($data);
                        $bool = $del->delete();

                    if($bool){
                        return redirect('admin/industry')->with('success',"删除成功");
                    }
                    return redirect('admin/industry')->with('error',"删除失败");
                }
                break;
            default:
                return redirect('admin/industry')->with('error',"删除失败");

        }
    }
}