<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\resume;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class ResumeController extends Controller
{
    public function add ()
    {
        return view('resume/add');
    }
    public function edit ()
    {
        return view('resume/edit');
    }
position/applyList

}