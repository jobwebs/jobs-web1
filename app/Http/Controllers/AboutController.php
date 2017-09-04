<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\about;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class AboutController extends Controller
{
    public function index ()
    {
        $data = array();

        $data['about'] = About::orderBy('wid','desc')
            ->first();
        return $data;
        //return view('about/index',['data' =>$data]);
    }
}