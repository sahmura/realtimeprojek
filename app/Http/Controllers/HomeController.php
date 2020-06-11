<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Courirs;
use App\User;
use App\Transactions;
use App\Addresses;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $addresses = Addresses::where('user_id', '=', Auth()->user()->id)->orderBy('id', 'DESC')->get();
        $orders = Transactions::where('user_id', '=', Auth()->user()->id)->with(['product', 'courir.user', 'user', 'address'])->orderBy('id', 'DESC')->get();
        $checkIfCourir = Courirs::where('user_id', '=', Auth()->user()->id)->count();
        if ($checkIfCourir != 0) {
            $courir = Courirs::where('user_id', '=', Auth()->user()->id)->first();
            $orderCourir = Transactions::where('courir_id', '=', $courir->id)->with(['product', 'courir.user', 'user', 'address'])->orderBy('id', 'DESC')->get();
        } else {
            $orderCourir = null;
        }
        return view('home', compact('addresses', 'orders', 'checkIfCourir', 'orderCourir'));
    }
}
