<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //市场调查员access()->hasRole(3)
        if(access()->hasRole(3)) return redirect(route('market.list'));
        //市场主管access()->hasRole(4)
        if(access()->hasRole(4))return redirect(route('market.list'));

        return view('frontend.user.dashboard')
            ->withUser(access()->user());
    }
}
