@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card " style="width: 18rem;">
                    <div class="card-header">
                        Products
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($products as $product)
                            <li class="list-group-item ">
                                <a href="{{ route('product.index',['type_id' => $product->type]) }}">{{ $product->type }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>


            </div>
            <div class="col-8">
                <div class="card" >
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <p>Name : {{ $item->name }}</p>
                        <p>Price : {{ $item->price }}</p>
                        <p>Type : {{ $item->type }}</p>
                        <p></p>
                        <p class="card-text">Detail : {{ $item->detail }}</p>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
