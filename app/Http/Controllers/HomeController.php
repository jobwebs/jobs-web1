<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Adverts;
use App\Position;
use App\News;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class HomeController extends Controller
{
    public function index ()
    {
        $data = array();
        $data['ad'] = HomeController::searchAd();
        $data['position'] = HomeController::searchPosition();
        $data['news'] = HomeController::searchNews();
        //return $data['news'];
        //return "index";
        return view('index',$data);
    }
    public function searchAd(){
        $data = array();//用以存放最终返回页面数组
        //查询广告,根据广告location倒序，符合有效期返回，大图6个，小图9个，文字21个
        $ad0 = Adverts::where('validity','>=',date('Y-m-d H-i-s'))
            ->where('type','=','0')
            ->orderBy('location', 'desc')
            ->take(6)
            ->get();
        $ad1 = Adverts::where('validity','>=',date('Y-m-d H-i-s'))
            ->where('type','=','1')
            ->orderBy('location', 'desc')
            ->take(9)
            ->get();
        $ad2 = Adverts::where('validity','>=',date('Y-m-d H-i-s'))
            ->where('type','=','2')
            ->orderBy('location', 'desc')
            ->take(21)
            ->get();
        $adnum = Adverts::where('validity','>=',date('Y-m-d H-i-s'))
            ->count();
        //return $adnum;
        $data['ad0']=$ad0;
        $data['ad1']=$ad1;
        $data['ad2']=$ad2;
        $data['adnum']=$adnum;//有效期内，所有广告数量
        return $data;
    }
    public function searchPosition()
    {
        $data = array();
        //搜索急聘职位信息（急聘和热门不一样，目前按照热门职位处理）
       $position = Position::where('vaildity','>=',date('Y-m-d H-i-s'))
            ->where('position_status','=',1)//职位状态
            ->orderBy('view_count','desc')
            ->take(12)
            ->get();
        $num = Position::where('vaildity','>=',date('Y-m-d H-i-s'))
            ->where('position_status','=',1)//职位状态
            ->count();
        $data['position'] = $position;
        $data['num'] = $num;
        return $data;
    }
    public function searchNews()
    {
        $data = array();
        //搜索最新新闻信息5条
        $new = News::orderBy('created_at','desc')
            ->take(5)
            ->get();
        $data['news'] = $new;
        return $data;
    }
}