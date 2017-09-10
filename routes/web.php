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

//登录注册
Route::get('account/login', function () {
    return view('account.login');
});
Route::post('account/login',['uses' => 'LoginController@postLogin']);   //完成
Route::get('account/logout',['uses' => 'LoginController@logout']);   //完成
Route::get('account/register', function () {
    return view('account.register');
});
Route::any('account/sms', ['uses' => 'ValidationController@sendSMS']);//发送短信验证码
Route::post('account/register', ['uses' => 'RegisterController@postRegister']);  //完成
Route::get('account/findPassword', function () {
    return view('account.findPassword');
});
//权限获取
Route::get('account/getType', ['uses' => 'AuthController@getType']);  //完成
Route::get('account/getUid', ['uses' => 'AuthController@getUid']);  //完成
//个人信息获取、新增、更新
Route::get('account/edit', function () {//进入方法，返回修改界面，带上个人信息。
    return view('account.edit');
});
Route::get('account/getPersonInfo', ['uses' => 'InfoController@getPersonInfo']);
Route::get('account/getEnprInfo', ['uses' => 'InfoController@getEnprInfo']);
Route::post('account/editPersonInfo', ['uses' => 'InfoController@editPersonInfo']);
Route::post('account/editEnprInfo', ['uses' => 'InfoController@editEnprInfo']);
Route::get('account/edit', function () {
    return view('account.edit');
});
//简历模块
Route::get('resume/add', ['uses' => 'ResumeController@getIndex']);
Route::post('resume/addIntention', ['uses' => 'ResumeController@addIntention']);
Route::any('resume/getRegion', ['uses' => 'ResumeController@getRegion']);
Route::any('resume/getIndustry', ['uses' => 'ResumeController@getIndustry']);

Route::get('resume/preview', function () {
    return view('resume.preview');
});

Route::get('account/index', function () {
    return view('account.index');
});
//企业号验证页面
Route::any('account/enterpriseVerify',['uses' => 'AccountController@enterpriseVerify']);
Route::any('account/enterpriseVerify/upload', ['uses' => 'AccountController@uploadpic']);

//职位发布、查看
Route::any('position/publish',['uses' => 'PositionController@publishIndex']);
Route::any('position/publish/add',['uses' => 'PositionController@publish']);
Route::any('position/publishList', ['uses' => 'PositionController@publishList']);
Route::any('position/publishList/delete', ['uses' => 'PositionController@delPosition']);
Route::any('position/detail',['uses' => 'PositionController@detail']);
Route::any('position/advanceSearch',['uses' => 'PositionController@advanceSearch']);

Route::get('position/applyList', function () {
    return view('position.applyList');
});
//新闻模块
Route::any('news/{pagnum?}',['uses' => 'NewsController@SearchNews'])->where('pagnum','[0-9]+');//完成
//Route::any('news/index',['uses' => 'NewsController@SearchNews']);
Route::any('news/detail',['uses' => 'NewsController@detail']);
Route::any('news/addReview', ['uses' => 'NewsController@addReview']);//添加评论
//Route::get('news/detail', function () {
//    return view('news.detail');
//});
//站内信模块
Route::any('message/',['uses' => 'MessageController@index']);//站内信主页
Route::any('message/index',['uses' => 'MessageController@index']);//站内信主页
Route::any('message/detail',['uses' => 'MessageController@detail']);//站内信详情
Route::any('message/read',['uses' => 'MessageController@isRead']);//设置已读

//网站信息模块
Route::any('about/',['uses' => 'AboutController@index']);//网站信息模块
Route::any('about/index',['uses' => 'AboutController@index']);//网站信息模块



//网站后台
Route::any('admin/industry',['uses' => 'admin\IndustryController@index']);//显示行业
Route::any('admin/industry/{option}',['uses' => 'admin\IndustryController@edit'])->where('option','[A-Za-z]+');//显示行业

Route::any('admin/occupation',['uses' => 'admin\OccupationController@index']);//显示职业
Route::any('admin/occupation/{option}',['uses' => 'admin\OccupationController@edit'])->where('option','[A-Za-z]+');//显示职业

Route::any('admin/region',['uses' => 'admin\RegionController@index']);//显示地区
Route::any('admin/region/{option}',['uses' => 'admin\RegionController@edit'])->where('option','[A-Za-z]+');//显示地区

//审批企业信息
Route::any('admin/verification/{option?}',['uses' => 'admin\VerificationController@index'])->where('option','[0-2]{1}');//显示待审核或已审核的企业信息
Route::any('admin/verification/detail',['uses' => 'admin\VerificationController@showDetail']);//显示待审核或已审核的企业信息
Route::any('admin/verification/examine',['uses' => 'admin\VerificationController@passVerfi']);//显示待审核或已审核的企业信息


Route::get('admin/login', function () {
    return view('admin/login');
});

Route::get('admin/', function () {
    return view('admin/dashboard');
});

Route::get('admin/dashboard', function () {
    return view('admin/dashboard');
});

Route::get('admin/enterprise', function () {
    return view('admin/enterprise');
});

Route::get('admin/admin', function () {
    return view('admin/admin');
});

Route::get('admin/region', function () {
    return view('admin/region');
});
Route::any('admin/ads',['uses' => 'admin\AdvertsController@index']);//显示已发布广告信息
Route::any('admin/ads/detail',['uses' => 'admin\AdvertsController@detail']);//显示已发布广告信息
Route::any('admin/news/addAds',['uses' => 'admin\AdvertsController@addAds']);//新增或修改广告信息

Route::get('admin/addAds', function () {
    return view('admin/addAds');
});
Route::any('admin/news',['uses' => 'admin\EditnewsController@index']);//显示已发布新闻信息
Route::any('admin/news/detail',['uses' => 'admin\EditnewsController@detail']);//显示已发布新闻信息
Route::any('admin/news/add',['uses' => 'admin\EditnewsController@addNews']);//新增或修改新闻信息

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
