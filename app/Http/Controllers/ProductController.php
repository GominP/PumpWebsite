<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{

    public function index()
    {
        $products = DB::table('products')->select('type')->distinct('type')->get();
        $types = Product::get()->where('type',"VARVEL");

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
        $validator = Validator::make($request->all(), [
            'name' => array('required', 'regex:/^[_A-z]*((-|\s)*[_A-z])*$/'),
            'price' => 'required','max:1000000',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.create')
                ->withErrors($validator)
                ->withInput();
        }

        $products = DB::table('products')->select('type')->distinct('type')->get();



        $req = new Product();
        $req->name = $request->input('name');
        $req->detail = $request->input('detail');
        $req->type = $request->input('type');
        $req->price = $request->input('price');


        $img = $request->file('file');
        $nameImg = time() . '-' . $request->input('name') . '.' . $img->getClientOriginalExtension();
        $des = public_path('/img/products');
        $img->move($des, $nameImg);

        $req->img = '/img/products/' . $nameImg;
        $req->save();

        return redirect()->route('product.create')->with('message','Created Success');
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
        $validator = Validator::make($request->all(), [
            'name' => array('required', 'regex:/^[_A-z]*((-|\s)*[_A-z])*$/'),
            'price' => 'required','max:1000000',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }

        $req =Product::find($product);



        $req->name = $request->input('name');
        $req->price = $request->input('price');
        $req->type = $request->input('type');
        $req->detail = $request->input('detail');
        $img = $request->file('file');
        if ($img != null){
            $nameImg = time() . '-' . $request->input('name') . '.' . $img->getClientOriginalExtension();
            $des = public_path('/img/products');
            $img->move($des, $nameImg);
            $req->img = '/img/products/' . $nameImg;
        }
        $req->save();

        return redirect()->route('product.index')->with('message','Success');

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {

        $req = Product::findOrFail($product);
        $req->delete();

        $products = DB::table('products')->select('type')->distinct('type')->get();
        $types = Product::get()->where('type','VARVEL');


        return view('product.index',[
            'types' => $types,
            'products' => $products

        ])->with('error'.'Deleted');
    }



}
