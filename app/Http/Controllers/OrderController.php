<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderList;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function index()
    {
        $user = Auth::id();
        $order = Order::all()->where('user_id','=',$user)->where('status','=','อยู่ในตะกร้า');
        $wait= Order::all()->where('user_id','=',$user)->where('status','=','รอการยืนยัน');
        $delivery = Order::all()->where('user_id','=',$user)->where('status','=','กำลังจัดส่ง');
        $success = Order::all()->where('user_id','=',$user)->where('status','=','เรียบร้อย');


        return view('order.index',[
        'order_lists' => $order,
            'delivery' => $delivery,
            'success' => $success,
            'wait' => $wait
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
    public function update(Request $request, $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = Order::findOrFail($id);
        $req->delete();
        $user = Auth::id();
        return redirect()->route('order.index');

    }

    public function order()
    {
        $user = Auth::id();
        $order = Order::all()->where('user_id','=',$user)->where('status','=','อยู่ในตะกร้า');
        $number = rand(1000,9999);
        foreach ($order as $o){
            $o->order_number = $number;
            $o->status = 'รอการยืนยัน';
            $o->save();
        }
        return redirect()->route('order.index')->with('message','Order Successfully');
    }


}
