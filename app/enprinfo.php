<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/26
 * Time: 9:57
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Enprinfo extends Model
{
    //指定表明
    protected $table = 'jobs_enprinfo';

    //指定主键idjobs_positon
    protected $primaryKey = 'eid';

    //允许批量赋值,自定义允许批量赋值的字段名
   // protected $fillable = ['name','age','sex'];
//pid,eid,title,tag,describe,salary,region,worknature，occupation,industry,experience,education、totalnum,max_age,validity,isreview,created_time,updated_time，position_status
    //自动维护时间戳
    public $timestamps = true;
    //自动维护时间字段保存unix时间戳
    protected function getDateFormat()
    {
        return time();
    }
    //通过orm获取时间戳自动格式化输出，该函数是限制自动格式化，直接返回
    protected function asDateTime($value)
    {
        return $value;
    }
}