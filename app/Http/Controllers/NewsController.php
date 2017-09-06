<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\news;
use App\Review;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index ()
    {
        return view('news/index');
    }
    //根据post的新闻id，返回新闻详情
    public function detail (Request $request)
    {
        $data = array();
        if(!$request->isMethod('POST'))
        {
            if($request->has('nid')){
                $nid = $request->input('nid');

                $news = News::find($nid);
                $data['news'] = $news;
                $news->view_count +=1;//浏览次数加1
                $news->save();
                //return $news;
                //return view('news/detail',$news);
                //查找新闻对应评论
                $review =Review::where('nid','=',$nid)
                    ->where('is_valid','=',1)
                    ->orderBy('created_at','desc')
                    ->get();
                $data['review'] = $review;

                //查找评论人相关信息
//                $userinfo = Personinfo::where('uid','=',$review['uid'])
//                    ->get();
//                $data['userinfo']
            }
        }
        return $data;
        //return view('news/detail', ['detail' => $data]);
    }
    //资讯中心页面、返回最新及最热门新闻,输入
    //返回值：data[]
    public function SearchNews (Request $request,$pagnum=9)
    {
        $data = array();
        $data['newest'] = NewsController::searchNewest($pagnum);//最新新闻
        $data['Hottest'] = NewsController::searchHottest();//最热新闻
        //return $data;
        return view('news.index',['newslist' => $data]);
    }
    public function searchNewest($num)
    {
        $data = array();
        $data = News::orderBy('created_at','desc')
            ->paginate($num);
        return $data;
    }
    public function searchHottest()
    {
        //取6条最热新闻
        $data = array();
        $data = News::orderBy('view_count','desc')
            ->take(6)
            ->get();
        return $data;
    }
    public function addreview(Request $request)
    {
        if($request->session()->has('uid')){//用户已登录
            $uid = $request->session()->get('uid');
            $review = $request->input('review');//传入review数组
            //测试数据开始
            $review['nid']=4;
            $review['content']="我是测试评论数据3";
            //测试数据结束
            $addReview = new Review();
            $addReview->nid = $review['nid'];
            $addReview->uid = $uid;
            $addReview->content = $review['content'];

            if($addReview->save()){
                return redirect('news/detail?nid='.$review['nid'])->with('success',"评论成功");
            }else{
                return redirect('news/detail?nid='.$review['nid'])->with('success',"评论失败");
            }
        }
    }
}
