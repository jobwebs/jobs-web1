<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/21
 * Time: 22:16
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public static function getUid() {            //判断是否登录，如果登录返回ID
        $id = session()->get('backUid');
        if ($id) {
            return $id;
        } else {
            return 0;
        }
    }

    public static function getType() {              //获得管理员的ID
        $type = session()->get('adminType');
        if ($type) {
            return $type;
        } else {
            return 0;
        }
    }
}