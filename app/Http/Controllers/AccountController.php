<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function enterpriseVerify (Request $request)
    {
        return view('account/enterpriseVerify');
        if($request->has('eid')){
            $eid = $request->input('eid');
            $num = DB::table('jobs_enprinfo')
                ->where('id',$eid)
                ->get();
            if($num==1){//企业已经在数据库中
                //ecertifi,lcertifi
                $ecertifi = $request->input('ecertifi');//企业营业执照
                $lcertifi = $request->input('lcertifi');//法人身份证

            }else{
                return 0;
            }
        }
    }

}