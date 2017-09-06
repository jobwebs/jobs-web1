<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/6
 * Time: 19:45
 */

namespace App\Http\Controllers;


class InfoController extends Controller
{

    public function getInfo()
    {}
    public function editInfo(Request $request)
    {
        //验证前台是否有传值 这个地方还没做
        $input = $request->all();

        $data = $request->input('position');
    }
}