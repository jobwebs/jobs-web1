<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Redirect;

class AuthController extends Controller {
    public static function getUid() {            //判断是否登录，如果登录返回ID

        if (Auth::check()) {
            $id = Auth::user()->uid;
            return $id;
        } else {
            return 0;
        }
    }

    public static function getType() {              //获得登录用户的种类，1：个人用户；2：企业用户
        $type = session()->get('type');
        if ($type) {
            return $type;
        } else {
            return 0;
        }
    }

}
