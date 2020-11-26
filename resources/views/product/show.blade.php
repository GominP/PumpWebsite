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
                    <img class="card-img-top" width="" height="350" src="{{asset( $item->img )}}" alt="Card image cap">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-2">Name :</dt>
                            <p class="col-sm-10">{{ $item->name }}</p>

                            <dt class="col-sm-2">Price :</dt>
                            <p class="col-sm-10">
                                {{ number_format( $item->price) }} Baht.
                            </p>

                            <dt class="col-sm-2">Type :</dt>
                            <dd class="col-sm-10">{{ $item->type }}</dd>

                        </dl>
                        <dt class="col-sm- text-truncate">Detail :</dt>
                        {{ $item->detail }}

                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
