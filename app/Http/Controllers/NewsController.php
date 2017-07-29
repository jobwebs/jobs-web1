<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\news;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class NewsController extends Controller
{
    public function index ()
    {
        return view('news/index');
    }
    public function detail ()
    {
        return view('news/detail');
    }
}