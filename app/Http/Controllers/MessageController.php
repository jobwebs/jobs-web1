<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Enprinfo;
use App\Http\Controllers\Controller;
use App\message;
use App\Personinfo;
use App\Users;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\Table;

class MessageController extends Controller
{
    //站内信主页，需返回数据站内信详情、及发送人信息（id、pic）

    public function index (Request $request)
    {
        $data = array();
        //需要先验证用户是否已登录
        $uid = $request->session()->get('uid');
        if($uid != "")
        {
            //echo "<pre>";
            $data['listMessage'] = Message::whereRaw('to_id =? and is_delete =?',[$uid,0])
                ->get();
            foreach($data['listMessage'] as $item){
                //var_dump($item);
                $uid = $item['attributes']['from_id'];
                $data['userinfo'][$uid] = MessageController::getUserinfo($uid);

                //var_dump($type);
            }
            return $data;
            //return view('message.index',['data' => $data]);
            //dd(response()->json($list));//转换为json数据格式报错
        }

        //return view("account/register");//未登陆跳转到登陆界面
    }

    //根据用户id，判断用户类型，并返回用户基本信息
    public function getUserinfo($uid=0)
    {
        $type =Users::where('uid','=',$uid)
            ->get();
        //var_dump($type);
        //var_dump($type[0]['attributes']['type']);
        //var_dump($type['attributes']['type']);
        if($type[0]['attributes']['type'] == 1){//普通用户
            $data = Personinfo::where('uid','=',$uid)
                ->get();
        }else if($type[0]['attributes']['type'] == 2){//企业用户
            $data = Enprinfo::where('uid','=',$uid)
                ->get();
        }else if($type[0]['attributes']['type'] == 3){//管理员
            $data = '管理员';//管理员头像可以用一个固定图片替代
        }
        return $data;
    }
    //发送站内信，传入to_id(原对话from_id)|message,数组形式
    public function sendMessage(Request $request)
    {
        $from_id = Session::get('uid');
        if($request->has('to_id')){
            $data = $request->input('message');
            if($from_id != ""){
                $message = new Message();
                $message->from_id = $from_id;
                $message->to_id = $data['toid'];
                $message->content = $data['content'];
                $message->save();
                return redirect()->back()->with('success','发送成功');
            }
        }
        return redirect()->back()->with('error','发送失败');
    }
    //删除站内信,传入待删除的mid数组

    public function delMessage(Request $request)
    {
        $mid = $request->input('mid');//传入message为数组
        foreach ($mid as $item){
            if($item != ""){
                $message = Message::find($item);//通过主键查找
                if($message->is_delete == 0){
                    $message->is_delete = 1;
                    $message->save();
                }
            }
        }
        return redirect()->back()->with('success','删除成功');
    }
    //标记为已读状态、传入mid数组
    public function isRead(Request $request)
    {
        $mid = $request->input('mid');
        foreach ($mid as $item) {
            if ($item != "") {
                $message = Message::find($item);//通过主键查找
                if ($message->is_read == 0) {
                    $message->is_read = 1;
                    $message->save();
                    return redirect()->back()->with('success', '已读成功');
                }
            }
        }
    }
    //站内信详情，与某人的对话内容，传入from_id,to_id,
    public function detail (Request $request)
    {
        $data = array();
        if($request->has('from_id')){
            $from_id = $request->input('from_id');
            $to_id = $request->session()->get('uid');

            if($from_id != "" && $to_id != ""){
                $data['message'] = Message::where('from_id','=',$from_id)
                    ->where('to_id','=',$to_id)
                    ->where('is_delete','=',0)//未删除
                    ->get();
                $data['userinfo'] = MessageController::getUserinfo($from_id);
            }
            //return $data;
            return view('message.detail',['data' => $data]);
        }

    }
    public  function test(Request $request){
        echo "test";
        $request->session()->put('uid',1);
        //echo $request->session()->get('uid');
        //dd($request->session()->all());
        $data = ['name'=>'jkjun','sex'=>'m'];
        return response()->json($data);
    }
    public function upload(Request $request)//测试文件上传功能
    {
        if($request ->isMethod('POST')){
            //dd($_FILES);//原生php方法
            $file = $request->file('source');
            $file2 = $request->file('source1');
//            dd($file);
//            exit;
            echo '<pre>';
            var_dump($file);
            var_dump($file2);
            if($file->isValid()){//判断文件是否上传成功
                //原文件名
                echo '文件上传成功';
                $originalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //mimetype
                $type = $file->getClientMimeType();
                //临时觉得路径
                $realPath = $file->getRealPath();

                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                echo $originalName.'\n';
                echo $ext.'\n';
                echo $type.'\n';
                echo $realPath.'\n';
                echo $filename;
                $bool = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
                var_dump($bool);
            }
            //dd($file);
            exit;
        }

        return view('upload.upload');

    }
}