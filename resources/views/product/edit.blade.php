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
                <form action="{{ route('product.show.update',['product_id'=> $item->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
{{--                        <img class="card-img-top"  style="height: 40rem" src="{{asset('img/v1.jpg')}}" alt="Card image cap">--}}
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" name="name"  value="{{ $item->name }}" placeholder="">

                        <label for="price " class="justify-content-center">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" placeholder="">

                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }} " placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <textarea class="form-control" id="detail" rows="3" name="detail" >{{ $item->detail }}</textarea>
                    </div>
                    <button type="submit"  name="orderBtn" class="btn btn-outline-success float-right"><i class="fas fa-edit"></i>Edit</button>

                </form>

            </div>
        </div>
    </div>
@endsection
