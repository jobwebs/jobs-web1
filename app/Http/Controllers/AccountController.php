<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Account;
use App\Enprinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller {
    public function login() {
        return view('account/login');
    }

    public function register() {
        return view('account/register');
    }

    public function findPassword() {
        return view('account/findPassword');
    }

    public function index($userid = 111) {
        print $userid;
        return view('account/index', [
            'userid' => $userid,
        ]);
    }

    public function edit() {
        return view('account/edit');
    }
    //如果options 为upload，则上传证件照片到数据库
    //返回值为$data数组
    public function enterpriseVerifyView(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();

        $uid = $data['uid'];

        if ($uid == 0)
            return view("/account/login", ['data' => $data]);

        $type = AuthController::getType();

        if ($type != 2)
            return redirect()->back();

        $eid = Enprinfo::select('eid')
            ->where('uid', '=', $uid)
            ->get();

        if (sizeof($eid) == 0)
            return redirect()->back();

        $eid = $eid[0]['eid'];
        $data['eid'] = $eid;
        if ($eid[0]['is_verification'] == 1) {
            //已验证
            $data['is_verification'] = 1;
        } else {
            //未验证
            $data['is_verification'] = 0;
        }

        $data['enterprise'] = Enprinfo::find($eid);
        return view("account.enterpriseVerify", ['data' => $data]);
    }

    //上传企业验证证件照片

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadpic(Request $request) {
        if ($request->has('eid')) {
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
                    if ($enprinfo->save()) {
                        $data['status'] = 200;
                        $data['msg'] = "上传成功";
                        return $data;
                        //return redirect('account/enterpriseVerify?eid='.$eid)->with('success', '上传证件成功');
                    } else {
                        $data['status'] = 400;
                        $data['msg'] = "失败";
                        return $data;
                        //return redirect('account/enterpriseVerify?eid='.$eid)->with('error', '上传证件失败');
                    }

                }
            }
        }
    }
}
