<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/5
 * Time: 下午12:53
 */

namespace App\Models\Market;


use Illuminate\Database\Eloquent\Model;

class MarketImage extends Model
{
    //protected $table = 'market_images';

    protected $fillable = ['image','market_id'];
}