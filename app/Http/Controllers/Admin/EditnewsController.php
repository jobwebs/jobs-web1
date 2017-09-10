<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class EditnewsController extends Controller
{
    //显示已发布广告,传入pagesize(每页大小)
    //返回data['news']
    public function index (Request $request)
    {
        $data = array();
        if($request->has('pagesize')){
            $pagesize = $request->input('pagesize');
        }else
            $pagesize = 20;//默认每页显示20页
        $data['news'] = News::orderBy('updated_at','desc')
            ->paginate($pagesize);
        return $data;
    }
    //根据新闻id 返回每个具体的新闻详情
    public function detail(Request $request)
    {
        $data = array();
        if($request->has('nid'))
        {
            $nid = $request->input('nid');
        }else
            $nid = 1;
        $data['new'] = News::find($nid);

        return $data;
    }
    //发布新闻以及修改已发布新闻
    //如果传入新闻id，则表示修改新闻，否则新增新闻。
    public function addNews(Request $request)
    {

        if($request->has('nid')){
            $new = News::find('nid');//修改已有新闻
        }else{
            $new = new News();//新增新闻
        }
        //接收参数
        $data = $request->input('newinfo');//接收新闻除图片之外的信息。
        $data['picture'] = "pic1@pic2@pic3@pic4";//测试数据
        $pictures = explode('@',$data['picture']);
        $picfilepath = "";
        foreach ($pictures as $Item){//对每一个照片进行操作。
            //echo $Item."<br>";
            //var_dump($picfilepath);
            continue;
            $pic = $request->file($Item);//取得上传文件信息
            if ($pic->isValid()) {//判断文件是否上传成功
                //取得原文件名
                $originalName1 = $pic->getClientOriginalName();
                //扩展名
                $ext1 = $pic->getClientOriginalExtension();
                //mimetype
                $type1 = $pic->getClientMimeType();
                //临时觉得路径
                $realPath = $pic->getRealPath();
                //生成文件名
                $picname = date('Y-m-d-H-i-s') . '-' . uniqid() . 'news' .$Item. '.' . $ext1;

                $picfilepath = $picfilepath.$Item.'@'.$picname.';';
                $bool = Storage::disk('newspic')->put($picname, file_get_contents($realPath));
            }
        }
        //保存都数据库
        $new->title = $data['title'];
        $new->subtitle = $data['subtitle'];
        $new->uid = 1;//uid 后期通过登录注册方法获取
        $new->quote = $data['quote'];
        $new->content = $data['content'];
        $new->picture = $picfilepath;
        $new->tag = $data['tag'];
        if($new->save()){
            return redirect()->back()->with('success','操作成功');
        }else{
            return redirect()->back()->with('error','操作失败');
        }
    }

}