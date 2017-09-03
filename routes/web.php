<?php
//z正式网站路由开始
//Route::get('index', function () {//主页返回四类广告（大图、小图、文字、急聘广告、最新新闻（5个）），
//    return view('index');
//});
//测试生成session uid
Route::any('session',['uses' => 'PositionController@test1']);
//
Route::any('/',['uses' => 'HomeController@index']);//完成
Route::any('/index',['uses' => 'HomeController@index']);//完成
Route::any('/index/search',['uses' => 'HomeController@indexSearch']);//完成

Route::get('account/login', function () {
    return view('account.login');
});
Route::get('account/register', function () {
    return view('account.register');
});
Route::get('account/edit', function () {//进入方法，返回修改界面，带上个人信息。
    return view('account.edit');
});
Route::get('account/edit', function () {
    return view('account.edit');
});
Route::get('account/findPassword', function () {
    return view('account.findPassword');
});

Route::get('account/', function () {
    return view('account.index');
});

Route::get('account/index', function () {
    return view('account.index');
});
//企业号验证页面
Route::any('account/enterpriseVerify/{options}',['uses' => 'AccountController@enterpriseVerify']);
Route::get('account/enterpriseVerify', function () {
    return view('account.enterpriseVerify');
});
Route::get('position/applyList', function () {
    return view('position.applyList');
});

Route::get('position/publish', function () {
    return view('position.publish');
});

Route::get('position/publishList', function () {
    return view('position.publishList');
});

Route::get('position/detail', function () {
    return view('position.detail');
});

Route::get('position/advanceSearch', function () {
    return view('position.advanceSearch');
});

Route::get('resume/add', function () {
    return view('resume.add');
});

Route::get('resume/preview', function () {
    return view('resume.preview');
});

Route::any('news/{pagnum?}',['uses' => 'NewsController@SearchNews'])->where('pagnum','[0-9]+');//完成
//Route::any('news/index',['uses' => 'NewsController@SearchNews']);
Route::any('news/detail',['uses' => 'NewsController@detail']);
Route::any('news/addreview',['uses' => 'NewsController@addreview']);//添加评论
//Route::get('news/detail', function () {
//    return view('news.detail');
//});


Route::get('about/', function () {
    return view('about.index');
});

Route::get('about/index', function () {
    return view('about.index');
});

Route::get('message/', function () {
    return view('message.index');
});

Route::get('message/index', function () {
    return view('message.index');
});

Route::get('message/detail', function () {
    return view('message.detail');
});

//end
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//招聘网站
//index
// Route::any('123',function (){
//     return "hello";
// });
// Route::get('/',function (){
//     return view('index');
// });
// Route::get('index',function (){
//     return view('index');
// });
// //account
// //打开session
// Route::group(['middleware' => ['web']], function (){
//     Route::any('account/{userid?}',['uses' => 'AccountController@index'])->where('userid','[0-9]+');
//     Route::any('account/login',['uses' => 'AccountController@login']);
//     Route::any('account/register',['uses' => 'AccountController@register']);
//     Route::any('account/findPassword',['uses' => 'AccountController@findPassword']);
//     Route::any('account/edit',['uses' => 'AccountController@edit']);
//     Route::any('account/enterpriseVerify/{options}',['uses' => 'AccountController@enterpriseVerify']);//企业号验证页面
// //resume
//     Route::any('resume/add',['uses' => 'ResumeController@add']);
//     Route::any('resume/edit',['uses' => 'ResumeController@edit']);

// //position
//     Route::any('position/applyList',['uses' => 'PositionController@applyList']);
//     //options 传递参数返回页面（index）新增数据（add）

//     Route::any('position/test1',['uses' => 'PositionController@test1']);
//     Route::any('position/publish/{options}',['uses' => 'PositionController@publish'])->where('options','[A-Za-z]+');
//     Route::any('position/publishList/{options}',['uses' => 'PositionController@publishList'])->where('options','[A-Za-z]+');
//     Route::any('position/detail',['uses' => 'PositionController@detail']);
//     Route::any('position/edit',['uses' => 'PositionController@edit']);
//     Route::any('position/advanceSearch',['uses' => 'PositionController@advanceSearch']);

// //news
//     Route::any('news',['uses' => 'NewsController@index']);
//     Route::any('news/detail',['uses' => 'NewsController@detail']);
//     Route::get('news/search',['uses' => 'NewsController@SearchNews']);//页面12，功能14
//     Route::get('news/list/{num}',['uses' => 'NewsController@SearchNews'])->where('num','[0-9]+');//页面12，功能54 直接输入每页显示数量倒序获取新闻列表



// //message
//     Route::any('message/index/{options}',['uses' => 'MessageController@index'])->where('options','[A-Za-z]+');
//     Route::any('message/detail',['uses' => 'MessageController@detail']);
//     Route::any('message/test',['uses' => 'MessageController@test']);
//     Route::any('message/upload',['uses' => 'MessageController@upload']);

// //about
//     Route::any('about',['uses' => 'AboutController@index']);

//     //发送短信
//     Route::any('validation/sendsms',['uses' => 'ValidationController@sendSMS']);
//     //发送邮箱
//     Route::any('validation/sendemail',['uses' => 'ValidationController@sendemail']);
//     //验证邮箱
//     Route::any('validate_email',['uses' => 'ValidationController@verifyEmailCode']);
// //招聘网站结束
// });

// Route::get('/hello',function(){
//     return "HELLO echo!";
// });
// //多请求路由
// Route::match(['get','post'],'multy1',function(){
//     return "multy1";
// });
// Route::any('test1','StudentController@test1');
// Route::any('query1',['uses' => 'StudentController@query1']);
// Route::any('query2',['uses' => 'StudentController@query2']);
// Route::any('query3',['uses' => 'StudentController@query3']);
// Route::any('query4',['uses' => 'StudentController@query4']);
// Route::any('orm1',['uses' => 'StudentController@orm1']);
// Route::any('orm2',['uses' => 'StudentController@orm2']);
// Route::any('student/index',['uses' => 'StudentController@index']);

// //路由参数
// Route::get('user/{id}',function ($id){
//     return 'user-id-'.$id;
// })->where('id','[0-9]+');

// //Route::get('user/{name?}',function ($name = 'jkjun'){
// //    return 'user-name-'.$name;
// //});
// //正则表达式来验证输入参数
// Route::get('user/{name?}',function ($name = 'jkjun'){
//     return 'user-name-'.$name;
// })->where('name','[A-Za-z]+');

// Route::get('user/{id?}/{name?}',function ($id ,$name = 'jkjun'){
//     return 'user-id-'.$id.'-name-'.$name;
// })->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);

// //session

// Route::group(['middleware'=> ['web']],function () {
//     Route::any('session1',['uses' => 'StudentController@session1']);
//     Route::any('session2',['uses' => 'StudentController@session2']);
// });
