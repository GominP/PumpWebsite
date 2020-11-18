@extends('layouts.app')
@section('style')

@endsection

@section('content')
    <div class="container justify-content-center">
        <div class="card " style="height: 40rem">
            <div class="card-header ">
                <div class="text-center">
                    <h3>Your Order</h3>
                </div>
                <ul class="nav nav-tabs card-header-tabs"  id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="true">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false">In Delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="success-tab" data-toggle="tab" href="#success" role="tab" aria-controls="success" aria-selected="false">Success</a>
                    </li>
                </ul>
            </div>
            <div class="card-columns">
                @foreach($orders as $order)
                <div class="card-body  tab le-responsive ">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset('img/v1.jpg')}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $order->order->product->name }}</h5>
                                    <a href="#" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade table-responsive" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                            <table class="table table-hover text-center"></table>

                        </div>

                        <div class="tab-pane fade table-responsive" id="success" role="tabpanel" aria-labelledby="success-tab">


                        </div>
                    </div>
                </div>
                @endforeach
            </div>


        </div>



    </div>

@endsection
