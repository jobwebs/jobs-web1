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
use Illuminate\Http\Request;
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
    //搜索新闻
    public function SearchNews (Request $request)
    {
        //return "news";
        if($request->isMethod('GET')){
            $keywords = $request->input('keywords');
            //$keywords = 'lol';
            $num = $request->input('num');
            $news = News::where('content','like','%'.$keywords.'%')
                ->paginate($num);
            dd($news);
        }

//        $handle = new Model();
//
//        // 如果条件1为真的时候
//        $keywords1 && $handle->where('field_name','like','%' . $keywords1 . '%');
//// 如果条件2为真的时候
//        $keywords2 && $handle->where('field_name','like','%' . $keywords2 . '%');
//// 如果条件3为真的时候
//        $handle->get();

//        return view('student.index',[
//            'students'=>$students,
//        ]);
    }
}