<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        $products = DB::table('products')->select('type')->distinct('type')->get();
        $types = Product::get()->where('type',$id);

        return view('product.index',[
            'types' => $types,
            'products' => $products
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $products = DB::table('products')->select('type')->distinct('type')->get();
        return view('product.create',[
            'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $img = $request->file('img');
        $nameImg = time() . '-' . $request->input('name') . '.' . $img->getClientOriginalExtension();
        $des = public_path('/img/product');
        $img->move($des, $nameImg);



        $req = new Product();
        $req->name = $request->input('name');
        $req->detail = $request->input('name');
        $req->type = $request->input('name');
        $req->price = $request->input('name');
        $req->img = '/images/profile/' . $nameImg;





    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Product::find($id);
        $products = DB::table('products')->select('type')->distinct('type')->get();
        $types = Product::get()->where('type',$id);

        return view('product.show',[
            'types' => $types,
            'products' => $products,
            'item' => $item
        ]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }


    public function editProduct($product)
    {
        $products = DB::table('products')->select('type')->distinct('type')->get();
        $item = Product::find($product);

        return view('product.edit',[
            'products' => $products,
            'item' => $item

        ]);

    }

    public function updateProduct(Request $request,$product)
    {
        $req =Product::find($product);
        $req->name = $request->input('name');
        $req->price = $request->input('price');
        $req->type = $request->input('type');
        $req->detail = $request->input('detail');

        $req->save();

        $products = DB::table('products')->select('type')->distinct('type')->get();
        $types = Product::get()->where('type',$req->type);




        return view('product.index',[
            'products' => $products,
            'item' => $req,
            'types' => $types,
        ])->with('message','Order Successfully');

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function updateImg(Request $request, $id) {
        if (!$request->file('img')) {
            return redirect()->back()->with('alert', 'เกิดข้อผิดพลาด');
        }

        $user = User::findOrFail($id);

        $img = $request->file('img');
        $input = time() . '-' . $user->first_name . '.' . $img->getClientOriginalExtension();
        $des = public_path('/images/profile');
        $img->move($des, $input);
        $user->img = '/images/profile/' . $input;

        $user->save();
        return redirect()->route('user.show', ['user' => $user->id])->with('alert', 'เปลี่ยนรูปประจำตัวเรียบร้อยแล้ว');
    }


}
