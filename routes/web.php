<?php

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
Route::any('123',function (){
    return "hello";
});
Route::get('/',function (){
    return view('index');
});
Route::get('index',function (){
    return view('index');
});
//account
Route::any('account/{userid?}',['uses' => 'AccountController@index']);
Route::any('account/login',['uses' => 'AccountController@login']);
Route::any('account/register',['uses' => 'AccountController@register']);
Route::any('account/findPassword',['uses' => 'AccountController@findPassword']);
Route::any('account/edit',['uses' => 'AccountController@edit']);
Route::any('account/enterpriseVerify',['uses' => 'AccountController@enterpriseVerify']);

//resume
Route::any('resume/add',['uses' => 'ResumeController@add']);
Route::any('resume/edit',['uses' => 'ResumeController@edit']);

//position
Route::any('position/applyList',['uses' => 'PositionController@applyList']);
Route::any('position/publish',['uses' => 'PositionController@publish']);
Route::any('position/publishList',['uses' => 'PositionController@publishList']);
Route::any('position/detail',['uses' => 'PositionController@detail']);
Route::any('position/edit',['uses' => 'PositionController@edit']);
Route::any('position/advanceSearch',['uses' => 'PositionController@advanceSearch']);

//news
Route::any('news',['uses' => 'NewsController@index']);
Route::any('news/detail',['uses' => 'NewsController@detail']);
Route::get('news/search',['uses' => 'NewsController@SearchNews']);

//message
Route::any('message',['uses' => 'MessageController@index']);
Route::any('message/detail',['uses' => 'MessageController@detail']);

//about
Route::any('about',['uses' => 'AboutController@index']);
//招聘网站结束
Route::get('/hello',function(){
    return "HELLO echo!";
});
//多请求路由
Route::match(['get','post'],'multy1',function(){
    return "multy1";
});
Route::any('test1','StudentController@test1');
Route::any('query1',['uses' => 'StudentController@query1']);
Route::any('query2',['uses' => 'StudentController@query2']);
Route::any('query3',['uses' => 'StudentController@query3']);
Route::any('query4',['uses' => 'StudentController@query4']);
Route::any('orm1',['uses' => 'StudentController@orm1']);
Route::any('orm2',['uses' => 'StudentController@orm2']);
Route::any('student/index',['uses' => 'StudentController@index']);

//路由参数
Route::get('user/{id}',function ($id){
    return 'user-id-'.$id;
})->where('id','[0-9]+');

//Route::get('user/{name?}',function ($name = 'jkjun'){
//    return 'user-name-'.$name;
//});
//正则表达式来验证输入参数
Route::get('user/{name?}',function ($name = 'jkjun'){
    return 'user-name-'.$name;
})->where('name','[A-Za-z]+');

Route::get('user/{id?}/{name?}',function ($id ,$name = 'jkjun'){
    return 'user-id-'.$id.'-name-'.$name;
})->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);

//session

Route::group(['middleware'=> ['web']],function () {
    Route::any('session1',['uses' => 'StudentController@session1']);
    Route::any('session2',['uses' => 'StudentController@session2']);
});
