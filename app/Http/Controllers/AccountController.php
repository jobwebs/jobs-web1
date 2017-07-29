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
    public function enterpriseVerify ()
    {
        return view('account/enterpriseVerify');
    }

}