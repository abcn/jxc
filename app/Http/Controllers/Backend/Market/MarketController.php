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
}