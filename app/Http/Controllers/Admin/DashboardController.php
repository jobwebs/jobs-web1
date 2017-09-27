<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller {
    public function view() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');

        return view('admin.dashboard', ["data" => self::getLoginInfo()]);
    }

    public static function getLoginInfo() {
        $uid = AdminAuthController::getUid();
        $data = array();
        $data['uid'] = $uid;
        $user = User::where("uid", $uid)->first();

        if ($user == null)
            return view('admin.login');

        $data['username'] = $user->username;

        return $data;
    }
}
