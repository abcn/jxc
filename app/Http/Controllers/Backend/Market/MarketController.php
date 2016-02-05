<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/4
 * Time: 上午11:13
 */

namespace App\Http\Controllers\Backend\Market;


use App\Http\Controllers\Controller;
use App\Models\Market\Market;
use App\Models\Market\MarketImage;
use Illuminate\Http\Request;

class MarketController extends Controller
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
        return view('backend.market.index');
    }

    public function create()
    {
        return view('backend.market.create');
    }

    public function store()
    {
        //存储数据
        $market = new Market();
        $market->title1 = $this->request->get('title1');
        $market->sc_price = $this->request->get('sc_price');
        $market->cb_price = $this->request->get('cb_price');
        $market->desc = $this->request->get('desc');
        $market->amount = $this->request->get('amount');
        $market->rank = $this->request->get('rank');
        $market->alibaba1 = $this->request->get('alibaba1');
        $market->alibaba2 = $this->request->get('alibaba2');
        $market->investigators = $this->request->get('investigators');
        $market->save();
        //获取图片
        $images = $this->request->file('images');
        foreach ($images as $image) {
            //获取图片名称
            $fileName = md5(uniqid(str_random(10)));
            //
            try {
                \Image::make($image)
                    ->resize(100,100)
                    ->save('uploads/images/'.$fileName.'.jpg');
                //存储图片
                $marketImage = new MarketImage();
                $marketImage->image = 'uploads/images/'.$fileName.'.jpg';
                $marketImage->market_id = $market->id;
                $marketImage->save();

            }catch (\Exception $e){
                //图片上传失败
                dd($e->getMessage());
            }
        }
        //通过循环存储照片
    }

    public function edit($id)
    {
        //
        $market = $this->market->with('image')->findOrFail($id);
        return view('backend.market.edit',compact('market'));
    }

    public function data()
    {
        $limit = $this->request->has('limit') ? $this->request->get('limit') : 10;
        $offset = $this->request->has('offset') ? $this->request->get('offset') : 0;
        $sort = $this->request->has('sort') ? $this->request->get('sort') : 'created_at';
        $order = $this->request->has('order') ? $this->request->get('order') : 'desc';
        $query = $this->market->select('*')->orderBy($sort,$order);
        $total = $query->count();
        //
        $orders  = $query
            ->skip($offset)
            ->take($limit)->get();
        return array('total' => $total, 'rows' => $orders);
    }

    public function action()
    {
        $id = $this->request->get('id');
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
}