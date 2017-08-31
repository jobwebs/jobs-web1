<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\message;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\Table;

class MessageController extends Controller
{
    public function index (Request $request,$options)
    {
        if($options =="send")
        {
            $uid = Session::get('uid');
            $data = $request->input('message');
            if($uid != ""){
                $message = new Message();
                $message->from_id = $uid;
                $message->to_id = $data['toid'];
                $message->content = $data['content'];
                $message->save();
                return redirect()->back()->with('success','发送成功');
            }
            return view('message/index');
        }
        else if ($options =="delete")
        {
            $mid = $request->input('mid');
            if($mid != ""){
                $message = Message::find($mid);//通过主键查找
                if($message->is_delete == 0){
                    $message->is_delete = 1;
                    $message->save();
                    return redirect()->back()->with('success','删除成功');
                }
            }

        }else if ($options =="meslist"){
            $uid = $request->session()->get('uid');

            if($uid != "")
            {
                $list = Message::whereRaw('to_id =? and is_delete =?',[$uid,0])
                    ->get();
                return $list;
                //dd(response()->json($list));//转换为json数据格式报错
            }else
                return view("account/register");//未登陆跳转到登陆界面

        }else if ($options =="isread"){
            $mid = $request->input('mid');
            if($mid != ""){
                $message = Message::find($mid);//通过主键查找
                if($message->is_read == 0){
                    $message->is_read = 1;
                    $message->save();
                    return redirect()->back()->with('success','已读成功');
                }
            }
        }
    }
    public function detail (Request $request)
    {
        $mid = $request->input('mid');
        echo $mid;
        echo 'aaa';
            if($mid != ""){
            $message = Message::find($mid);//通过主键查找
            if($message->is_delete == 0){
                dd($message);
                //return view('message/detail',$message);
            }
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