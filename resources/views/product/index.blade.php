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
                <div class="row ">
                    <div class="card-columns">
                        @foreach($types as $type)
                        <div class="card border-primary mb-3" style="width: 18rem;">
                            <img class="card-img-top" style="height: 13rem" src={{asset('img/v1.jpg')}} alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $type->name }}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
{{--                                <li class="list-group-item">Price : {{ $type->price }}--}}
{{--                                </li>--}}
                            </ul>
                            <div class="card-body">
                                <a href="{{ route('product.show',['product_id' => $type->id]) }}">
                                    <button type="button" class="btn btn-outline-primary">Show detail</button>
                                </a>
                                <a>
                                    <button type="button" class="btn btn-outline-success"
                                            data-name="{{ $type->name }}"
                                            data-pid="{{ $type->id }}"
                                            data-toggle="modal" data-target="#cart">
                                        Add to Cart
                                    </button>
                                </a>
{{--                                <a href="{{ route('order.store',['product_id' => $type->id]) }}">--}}
{{--                                    <button type="button" class="btn btn-outline-success">Add to Cart</button>--}}
{{--                                </a>--}}


                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
    <!-- Modal -->
        <div class="modal fade" id="cart" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input  id="pid" hidden>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Amount</span>
                            </div>
                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-prepend">
                                <span class="input-group-text">unit</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>




@endsection
