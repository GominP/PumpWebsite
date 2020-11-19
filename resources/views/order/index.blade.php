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
                <div class="card-body table-responsive ">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="report-tab">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    @foreach($order_lists as $order)
                                        <tr>
                                            <td>{{$order->product->name}}</td>
                                            <td>{{$order->quantity}}</td>
                                            <td>
                                                <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-outline-danger btn-lg" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot class="float-right">
                                        <form action="{{ route('order.cart.update') }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success float-right">Order all</button>
                                        </form>
                                    </tfoot>
                                </table>
                        </div>
                        <div class="tab-pane fade show " id="delivery" role="tabpanel" aria-labelledby="report-tab">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($delivery as $deli)
                                    <tr>
                                        <td>{{$deli->product->name}}</td>
                                        <td>{{$deli->quantity}}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="tab-pane fade show " id="success" role="tabpanel" aria-labelledby="report-tab">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Amount</th>



                                </tr>
                                </thead>
                                <tbody>
                                @foreach($success as $s)
                                    <tr>
                                        <td>{{$s->product->name}}</td>
                                        <td>{{$s->quantity}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
    </div>

@endsection
