<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\about;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class WebinfoController extends Controller
{
    //显示网站信息
    public function index ()
    {
        $data = array();
        $data['webinfo'] = about::orderBy('updated_at','desc')
            ->take(1)
            ->get();
        return $data;
    }
    //修改网站信息
    public function setWebinfo(Request $request)
    {
        if($request->has('webinfo')){
            $data = $request->input('webinfo');
            $webinfo = about::findfirst();
            $webinfo->uid = 1;//登陆获取
            $webinfo->tel = $data['tel'];
            $webinfo->email = $data['email'];
            $webinfo->address = $data['address'];
            $webinfo->class = $data['class'];
            $webinfo->content = $data['content'];
            $webinfo->work_time = $data['work_time'];
            if($webinfo->save())
            {
                return redirect()->back()->with('success','操作成功');
            }
        }

        return redirect()->back()->with('success','操作成功');
    }
}