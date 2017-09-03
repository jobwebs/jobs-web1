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
use App\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\Table;

class AccountController extends Controller
{
    public function login ()
    {
        return view('account/login');
    }
    public function register ()
    {
        return view('account/register');
    }
    public function findPassword ()
    {
        return view('account/findPassword');
    }
    public function index ($userid = 111)
    {
        print $userid;
        return view('account/index',[
            'userid' => $userid,
        ]);
}
    public function edit ()
    {
        return view('account/edit');
    }
    //如果options 为upload，则上传证件照片到数据库
    //返回值为$data数组
    public function enterpriseVerify (Request $request)
    {
        $data = array();
        if($request->has('eid')){
            $eid = $request->input('eid');
            $num = DB::table('jobs_enprinfo')
                ->where('eid',$eid)
                ->get();
            if($num){//企业已经在数据库中
                //ecertifi,lcertifi
//                $ecertifi = $request->input('ecertifi');//企业营业执照
//                $lcertifi = $request->input('lcertifi');//法人身份证
                //企业已经上传证件照片，则返回审核状态,否则跳转到上传文件页面
                $enterprise = Enprinfo::find($eid);

                if($enterprise-> ecertifi !='' && $enterprise-> lcertifi !=''){
                    //企业证件已上传，返回审核状态值
                    $data['state'] = $enterprise->is_verification;

                    return view('account.enterpriseVerify',['data' => $data])->with('message','用户已上传资料');
                    //return $data;

                }else {
                    return view('upload.upload')->with('message','用户未上传资料');//未上传证件，返回到上传页面。
                    //return view('account.enterpriseVerify')->with('message','用户未上传资料');//未上传证件，返回到上传页面。
                }
            }else{
                return view('account/register');//企业未注册
            }
        }
    }

    //上传企业验证证件照片
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadpic(Request $request)
    {
        if($request->has('eid')) {
            $eid = $request->input('eid');
            if ($request->isMethod('POST')) {
                $ecertifi = $request->file('ecertifi');//取得上传文件信息
                $lcertifi = $request->file('lcertifi');//取得上传文件信息

                if ($ecertifi->isValid() && $lcertifi->isValid()) {//判断文件是否上传成功
                    //原文件名
                    //echo '文件上传成功';
                    $originalName1 = $ecertifi->getClientOriginalName();
                    $originalName2 = $lcertifi->getClientOriginalName();
                    //扩展名
                    $ext1 = $ecertifi->getClientOriginalExtension();
                    $ext2 = $lcertifi->getClientOriginalExtension();
                    //mimetype
                    $type1 = $ecertifi->getClientMimeType();
                    $type2 = $lcertifi->getClientMimeType();
                    //临时觉得路径
                    $realPath1 = $ecertifi->getRealPath();
                    $realPath2 = $lcertifi->getRealPath();

                    $filename1 = date('Y-m-d-H-i-s') . '-' . uniqid() . 'ecertifi' . '.' . $ext1;
                    $filename2 = date('Y-m-d-H-i-s') . '-' . uniqid() . 'lcertifi' . '.' . $ext2;

                    $bool1 = Storage::disk('uploads')->put($filename1, file_get_contents($realPath1));
                    $bool2 = Storage::disk('uploads')->put($filename2, file_get_contents($realPath2));
                    //var_dump($bool);

                    //文件名保存到数据库中
                    $enprinfo = Enprinfo::find($eid);
                    $enprinfo->ecertifi = $filename1;
                    $enprinfo->lcertifi = $filename2;
                    if($enprinfo->save())
                    {
                        return redirect('account/enterpriseVerify?eid='.$eid)->with('success', '上传证件成功');
                    }else{
                        return redirect('account/enterpriseVerify?eid='.$eid)->with('error', '上传证件失败');
                    }

                }
            }
        }
    }

    public function test()
    {

    }
}