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
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class AdvertsController extends Controller
{
    //显示已发布广告
    //如果传入显示广告type，则按type返回
    public function index (Request $request)
    {
        $data = array();
        if($request->has('pagesize')){
            $pagesize = $request->input('pagesize');
        }else{
            $pagesize = 20;//默认每页显示20条数据
        }
        if($request->has('type')){
            $type = $request->input('type');
            $data['adlist'] = Adverts::where('type','=',$type)
                ->orderBy('updated_at','desc')
                ->paginate($pagesize);
        }else{
            $data['adlist'] = Adverts::orderBy('updated_at','desc')
                ->paginate($pagesize);
        }

        return $data;
    }
    //根据广告id 返回每个具体的广告详情
    public function detail(Request $request)
    {
        $data = array();
        if($request->has('adid'))
        {
            $adid = $request->input('adid');
        }else
            $adid = 1;

        $data['advert'] = Adverts::find($adid);

        return $data;
    }
    //发布广告、以及修改广告
    //如果传入广告id，则修改对应广告
    //广告信息域用adsinfo  \ 广告图片域adpic
    public function addAdvert(Request $request)
    {
        $data = array();
        if($request->has('adid')){
            $ad = Adverts::find('adid');//修改已有广告
        }else{
            $ad = new Adverts();//新增广告
        }
        //接收参数
        $data = $request->input('adsinfo');//接收广告除图片之外的信息。

        if($data['type']==0||$data['type']==1){//大图和小图广告\图片上传
            $adpic = $request->file('adpic');//取得上传文件信息
            if ($adpic->isValid()) {//判断文件是否上传成功
                //取得原文件名
                $originalName = $adpic->getClientOriginalName();
                //扩展名
                $ext = $adpic->getClientOriginalExtension();
                //mimetype
                $type = $adpic->getClientMimeType();
                //临时觉得路径
                $realPath = $adpic->getRealPath();
                //生成文件名
                $picname = date('Y-m-d-H-i-s') . '-' . uniqid() . 'adpic' . '.' . $ext;

                $bool = Storage::disk('adpic')->put($picname, file_get_contents($realPath));

                $ad->picture = $picname;
            }
        }
        //ad信息保存到数据库
        $ad->uid = 1;//从登陆验证接口获取
        $ad->title = $data['title'];
        $ad->content = $data['content'];
        $ad->type = $data['type'];
        $ad->location = $data['location'];
        $ad->homepage = $data['homepage'];
        $ad->validity = $data['validity'];

        if($ad->save())
        {
            return redirect()->back()->with('success','新增广告成功');
        } else
            return redirect()->back()->with('error','新增广告失败');
    }
}