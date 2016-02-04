<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/5
 * Time: 上午12:20
 */

namespace App\Http\Controllers\Frontend\Market;


use App\Http\Controllers\Controller;
use App\Models\Market\Market;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $market;
    protected $request;

    public function __construct(Market $market,Request $request)
    {
        $this->market = $market;
        $this->request = $request;
    }

    public function index()
    {
        if(access()->user() == null){
            return redirect(route('market.login'));
        }
        //获取商品列表
        $products = $this->market->all();

        return view('frontend.market.goods-list',compact('products'));
    }

    public function info($id)
    {
        //TODO 检测用户权限
        //获取商品信息
        $info = $this->market->findOrFail($id);
        return view('frontend.market.goods-info',compact('info'));
    }

    public function action($id)
    {
        if(access()->user() == null){
            return redirect(route('market.login'));
        }
        //获取商品信息
        $info = $this->market->findOrFail($id);
        //获取状态信息
        $status = $this->request->get('status');

        $info->status = $status;
        if($info->save()){
            return array('status' => 'success');
        }else{
            return array('status' => 'false');
        }

    }

    public function login()
    {
        if(access()->hasRole(3) || access()->hasRole(4)){
            return redirect(route('market.list'));
        }
        return view('frontend.market.home-page');
    }
}