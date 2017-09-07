<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\about;

class AboutController extends Controller
{
    public function index ()
    {
        $data = array();

        $data['about'] = About::orderBy('wid','desc')
            ->first();
        //return $data;
        return view('about/index', ['data' => $data]);
    }
}
