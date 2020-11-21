<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderList;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function index()
    {
        $user = Auth::id();
        $check = Order::all()->where('user_id','=',$user)->where('status','=','ตะกร้า')->first();
        if ($check === null){
            $check = new Order();
            $check->user_id = $user;
            $check->status = 'ตะกร้า';
            $check->save();
        }
        $amoutPrice = 0;
        $orders = OrderList::all()->where('order_id','=',$check->id);
        $waits = Order::all()->where('user_id','=',$user)->where('status','=','รอการยืนยัน');
        foreach ($orders as $order){
            $temp = 0;
            $temp += $order->price * $order->quantity;
            $amoutPrice += $temp;
        }
        $delivery = Order::all()->where('user_id','=',$user)->where('status','=','กำลังจัดส่ง');
        $success = Order::all()->where('user_id','=',$user)->where('status','=','เรียบร้อย');

        return view('order.index', [
                'order_lists' => $orders,
                'waits' => $waits,
                'delivery' => $delivery,
                'success' => $success,
                'amoutPrice'=> $amoutPrice
                ]
        );
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
        $user = Auth::id();
        $check = Order::all()->where('user_id','=',$user)->where('status','=','ตะกร้า')->first();
//        dd($check);
        if ($check === null){
            $check = new Order();
            $check->user_id = $user;
            $check->status = 'ตะกร้า';
            $check->save();
        }

        $item = Product::findOrFail($request->input('p_id'));

        $cart = new OrderList();
        $cart->product_id =$item->id;
        $cart->order_id =$check->id;
        $cart->price =$item->price;
        $cart->quantity= $request->input('amount');
        $cart->save();

        //        $order->order_start_date = Carbon::today();
//        $order->order_end_date = Carbon::today()->addDay(3);
        return redirect()->route('product.index')->with('message','Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param   $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $orders = OrderList::all()->where('order_id','=',$order);
        $total = 0 ;
//        $o_id = OrderList::all()->where('order_id','=',$order)->first();
        $find = Order::find($order);
        $user = User::find($find->user_id);

        foreach ($orders as $order){
            $temp = 0;
            $temp += $order->product->price*$order->quantity;
            $total += $temp;
        }



        return view('order.show',[
            'orders' => $orders,
            'total' => $total,
            'user'=> $user
        ]);
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
        $req = OrderList::find($id);
        $req->delete();
        return redirect()->route('order.index');

    }

    public function order()
    {
        $user = Auth::id();
        $order = Order::all()->where('user_id','=',$user)->where('status','=','ตะกร้า')->first();
        $order_lists = OrderList::all()->where('order_id','=',$order->id);
        $number = rand(000000,999999);

        $order->order_number = $number;
        $order->status = 'รอการยืนยัน';
        $order->save();

//        $orderL = new OrderList();
//        $orderL->user_id = $user;
//        $orderL->order_number = $number;
//        $orderL->save();

        return redirect()->route('order.index')->with('message','Order Successfully');
    }

    public function editOrder()
    {
        $user = Auth::id();

        $wait = DB::table('orders')->select('order_number')->distinct('order_number')
            ->where('status', '=', 'รอการยืนยัน')->get();

        $delivery = DB::table('orders')->select('order_number')->distinct('order_number')
            ->where('status', '=', 'กำลังจัดส่ง')->get();

        $success = DB::table('orders')->select('order_number')->distinct('order_number')
            ->where('status', '=', 'เรียบร้อย')->get();

//        $success = DB::table('orders')->select('order_number')->distinct('order_number')
//            ->where('user_id','=',$user)
//            ->where('status','=','เรียบร้อย')->get();


        return view('order.edit', [
            'delivery' => $delivery,
            'wait' => $wait,
            'success'=>$success
        ]);
    }

    public function orderDelivery($order)
    {
        $orders = Order::all()->where('order_number','=',$order)->where('status','=','รอการยืนยัน');
        foreach ($orders as $o){
            $o->status = 'กำลังจัดส่ง';
            $o->save();
        }
        return redirect()->route('order.edit')->with('message','Confirm Order');
    }

    public function orderConfirm($order)
    {
        $orders = Order::all()->where('order_number','=',$order)->where('status','=','กำลังจัดส่ง');
        foreach ($orders as $o){
            $o->status = 'เรียบร้อย';
            $o->save();
        }
        return redirect()->route('order.edit')->with('message','Confirm Order');
    }

    public function deleteFormOrderID($order)
    {
        $orders = Order::all()->where('order_number','=',$order)->where('status','=','รอการยืนยัน');
        foreach ($orders as $o){
            $o->delete();
        }
        return redirect()->route('order.edit')->with('info','Successfully');

    }


}
