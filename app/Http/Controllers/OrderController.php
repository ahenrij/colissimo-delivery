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

use Illuminate\Support\Facades\DB;
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
        $orders = Order::orderBy('id', 'desc')->paginate(15);
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

        DB::beginTransaction();

        try {
            // Store order
            $order_id = DB::table('orders')->insertGetId([
                'no' => $request->no,
                'customer_name' => $request->customer_name,
                'delivery_address' => $request->delivery_address,
                'website' => $request->website, 
            ]);

            // Store items
            $items_data = [];
            foreach ($request->items as $item) {
                $items_data[] = [
                    'no' => $item[0],
                    'title' => $item[1],
                    'quantity' => $item[2],
                    'order_id' => $order_id
                ];
            }
            DB::table('items')->insert($items_data);

            // Set first status in history (date field is current timestamp)
            DB::table('histories')->insert([
                'order_id' => $order_id,
                'status_id' => 1, // IMPORTANT! first status id
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Order created successfully']);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Une erreur est survenue: ' . $e->getMessage()]);            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $status = DB::table('status')->get(); // all status
        $status_history = $order->orderedStatusHistory();
        return view('orders.view', compact('order', 'status', 'status_history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $status_history = $order->orderedStatusHistory();
        $next_status = $order->nextStatus();
        return view('orders.update', compact('order', 'status_history', 'next_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $date = \DateTime::createFromFormat('d/m/Y H:i:s', $request->datetime);
        $next_status = $order->nextStatus();

        if ($next_status) {
            DB::table('histories')->insert([
                'order_id' => $order->id,
                'status_id' => $next_status->id,
                'date' => $date
            ]);
            return redirect()->route('orders.index')->withStatus('Success !');
        } else {
            return redirect()->back()->withError('Prochain statut non défini !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->withStatus('Success !');
    }
}
