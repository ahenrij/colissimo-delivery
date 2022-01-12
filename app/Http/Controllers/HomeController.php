<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $orders_count = DB::table('orders')->count();
        $treated_count = $this->getOrdersCountByStatus("traité");
        $delivered_count = $this->getOrdersCountByStatus("livré");
        $waiting_count = $this->getOrdersCountByStatus("attente");
        $sent_count = $this->getOrdersCountByStatus("expédié");
        $ongoing_count = $this->getOrdersCountByStatus("cours");

        return view('home', compact('orders_count', 'treated_count', 'delivered_count', 'waiting_count', 'sent_count', 'ongoing_count'));
    }

    /**
     * Show about page.
     */
    public function about()
    {
        return view('about');
    }

    private function getOrdersCountByStatus($status) {
        return DB::table('orders')
            ->join('histories', 'orders.id', '=', 'histories.order_id')
            ->join('status', 'status.id', '=', 'histories.status_id')
            ->where('status.title', 'like', "%".$status."%")
            ->count();
    }
}
