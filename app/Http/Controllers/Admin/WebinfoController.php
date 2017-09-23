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
        $uid = AdminAuthController::getUid();
//        if($request->has('webinfo')){
//            $data = $request->input('webinfo');
            $webinfo = about::findfirst();
            $webinfo->uid = 1;//登陆获取
            $webinfo->tel = $request->input('tel');
            $webinfo->email = $request->input('email');
            $webinfo->address = $request->input('address');
            $webinfo->class = $request->input('class');
            $webinfo->content = $request->input('content');
            $webinfo->work_time = $request->input('work_time');
            if($webinfo->save())
            {
                $data['status'] = 200;
                $data['msg'] = "操作成功";
                return $data;
//                return redirect()->back()->with('success','操作成功');
            }
        $data['status'] = 400;
        $data['msg'] = "操作失败";
        return $data;
//        return redirect()->back()->with('success','操作成功');
    }
}