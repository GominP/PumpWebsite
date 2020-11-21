@extends('layouts.app')
@section('style')
    .thead{
    }

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
                        <a class="nav-link active" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="true"> <i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="success-tab" data-toggle="tab" href="#wait" role="tab" aria-controls="wait" aria-selected="false"><i class="fas fa-spinner"></i> Wait for Confirm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false"><i class="fas fa-truck"></i> In Delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="success-tab" data-toggle="tab" href="#success" role="tab" aria-controls="success" aria-selected="false"><i class="fas fa-clipboard-check"></i> Success</a>
                    </li>
                </ul>
            </div>
                <div class="card-body table-responsive sticky-top " >
                    <div class="tab-content" id="myTabContent" >
                        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="report-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-8">
                                        <table class="table table-hover table-responsive-xl text-center" name="tableCart">
                                            <thead style="top: 0; position: sticky">

                                            <tr>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($order_lists === null)
                                                <tr>
                                                    <td>No data</td>
                                                </tr>
                                            @else
                                                @foreach($order_lists as $order)
                                                    <tr>
                                                        <td>{{$order->product->name}}</td>
                                                        <td>{{$order->quantity}}</td>
                                                        <td>{{number_format($order->product->price)}} Baht.</td>

                                                        <td>
                                                            <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button name="deleteBtn" class="btn btn-outline-danger btn-lg" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($order_lists !== null)
                                        <div class="col-4">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th>total</th>
                                                    <th colspan="8"></th>
                                                    <th class="text-right">{{number_format($amoutPrice)}}</th>
                                                </tr>
                                                <tr >
                                                    <th>vat 7%</th>
                                                    <th colspan="8"></th>
                                                    <th class="text-right">{{number_format($amoutPrice*0.07)}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Total(+vat)</th>
                                                    <th colspan="8"></th>
                                                    <th class="text-right">{{number_format($amoutPrice*0.07+$amoutPrice)}} Baht</th>
                                                </tr>
                                                </tbody>

                                            </table>
                                            <div class="justify-content-end">
                                                @if($order_lists)
                                                    <form  class="float-right" action="{{ route('order.cart.update') }}" method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <button type="submit"  name="orderBtn" class="btn btn-outline-success float-right " > <i class="fas fa-plus fa-fw"></i>Order</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                    @endif

                                </div>


                            </div>

                        </div>

                        <div class="tab-pane fade show " id="wait" role="tabpanel" aria-labelledby="report-tab">
                            <table class="table table-hover text-center" name="tableDelivery">
                                @if($waits === null)
                                    No data
                                @else
                                    <thead>
                                    <tr>
                                        <th scope="col">Order Number </th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($waits as $wait)
                                        <tr>
                                            <td>
                                                {{$wait->order_number}}
                                            </td>
                                            <td>
                                                <a href="{{ route('order.show',['order' => $wait->id]) }}">
                                                    <button name="showDetailBtn" type="button" class="btn btn-outline-primary">Show detail</button>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="tab-pane fade show " id="delivery" role="tabpanel" >
                            <table class="table table-hover text-center" name="tableDelivery">
                                <thead>
                                <tr>
                                    <th scope="col">Order Number </th>
                                    <th scope="col">Detail</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($delivery as $deli)
                                    <tr>
                                        <td>{{$deli->order_number}}</td>
                                        <td>
                                            <a href="{{ route('order.show',['order' => $deli->id]) }}">
                                                <button name="showDetailBtn" type="button" class="btn btn-outline-primary">Show detail</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                            </table>
                        </div>
                        <div class="tab-pane fade show " id="success" role="tabpanel" aria-labelledby="report-tab">
                            <table class="table table-hover text-center" name="table" name="tableSuccess">
                                <thead>
                                <tr>
                                    <th scope="col">Product List ID</th>
                                    <th scope="col">Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($success as $s)
                                    <tr>
                                        <td>{{$s->order_number}}</td>
                                        <td>
                                            <a href="{{ route('order.show',['order' => $s->id]) }}">
                                                <button name="showDetailBtn" type="button" class="btn btn-outline-primary">Show detail</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                            </table>
                        </div>
            </div>
        </div>
    </div>

@endsection
