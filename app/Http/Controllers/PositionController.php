<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\position;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class PositionController extends Controller
{
    public function applyList ()
    {
        return view('position/applyList');
    }
    public function publish ()
    {
        return view('position/publish');
    }
    public function publishList ()
    {
        return view('position/publishList');
    }
    public function detail ()
    {
        return view('position/detail');
    }
    public function edit ()
    {
        return view('position/edit');
    }
    public function advanceSearch ()
    {
        return view('position/advanceSearch');
    }
}