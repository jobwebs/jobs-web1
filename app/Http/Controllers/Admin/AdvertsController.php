<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Adverts;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class AdvertsController extends Controller
{
    //显示已发布广告
    public function index ()
    {
        $data = array();

        return "123";
    }
}