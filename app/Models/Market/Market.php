<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/4
 * Time: 上午11:14
 */

namespace App\Models\Market;


use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = ['status','title1','sc_price','cb_price','rank','desc','alibaba1','alibaba2','investigators','amount'];

    public function image()
    {
        return $this->hasMany('App\Models\Market\MarketImage');
    }
}