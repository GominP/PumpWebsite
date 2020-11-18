<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderList;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::id();
        $ol = OrderList::all()->where('user_id','=',$user);
//        dd($ol);
        return view('order.index',[
        'orders' => $ol
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|min:1'
        ]);

        $item = Product::findOrFail($request->input('p_id'));
        $user = Auth::id();

        $order = new Order();
        $order->user_id = $user;
        $order->product_id =$item->id;
        $order->quantity= $request->input('amount');
        $order->status = "อยู่ในตะกร้า";
        $order->order_start_date = Carbon::today();
        $order->order_end_date = Carbon::today()->addDay(3);

        $order->save();


        $order_list = new OrderList();
        $order_list->user_id = $user;
        $order_list->order_id = $order->id;
        $order_list->save();


//        dd($item->type);
//        dd($request->input('amount'));


//        $item = Product::findOrFail($request->input('pid'));
//        error_log($item);

        return redirect()->route('product.index',['type_id' => 'VARVEL'])->with('message','Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
