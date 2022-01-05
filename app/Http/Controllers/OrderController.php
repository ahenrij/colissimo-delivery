<?php

/**
 * A huge assomption is made in this controller.
 * We assume that status are correctly ordered by id
 * inside the database from 1 (Order treated) to 5 (Delivered)
 * 
 * This state is guaranteed by laravel migration but maybe not be if 
 * database is installed by another mean.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(15);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Store a newly created order with related items from ajax request.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return json response
     */
    public function storeOrder(Request $request) {
        
        // Store order
        DB::table('orders')->insert([
            'customer_name' => $request->customer_name,
            'delivery_address' => $request->delivery_address,
            'website' => $request->website, 
        ]);

        // Store items
        $items_data = [];
        foreach ($request->items as $item) {
            $items_data.push([
                'title' => $item[0],
                'quantity' => $item[0]
            ]);
        }
        DB::table('items')->insert($items_data);

        // Set first status in history
        DB::table('history')->insert([
            'order_id' => 1,
            'status_id' => 1, // IMPORTANT! First status
        ]);

        return response()->json(['success' => true, 'message' => 'Order created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
