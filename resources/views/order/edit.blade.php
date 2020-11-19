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
                        <a class="nav-link active" id="cart-tab" data-toggle="tab" href="#wait" role="tab" aria-controls="cart" aria-selected="true">Wait for Confirm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="success-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="wait" aria-selected="false">In Delivery</a>
                    </li>
                </ul>
            </div>
            <div class="card-body table-responsive ">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="wait" role="tabpanel" aria-labelledby="report-tab">
                        <table class="table table-hover text-center" name="tableCart">
                            <thead>
                            <tr>
                                <th scope="col">Product List ID</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Confirm</th>
                                <th scope="col">Delete</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wait as $i)
                                <tr>
                                    <td>{{$i->order_number}}</td>
                                    <td>
                                        <a href="{{ route('order.show',['order' => $i->order_number]) }}">
                                            <button name="showDetailBtn" type="button" class="btn btn-outline-primary">Show detail</button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('order.delivery.update', ['order' => $i->order_number]) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <button name="deleteBtn" class="btn btn-outline-success btn-lg" type="submit">Confirm</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('order.delete.num', ['order' => $i->order_number]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button name="deleteBtn" class="btn btn-outline-danger btn-lg" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade show " id="delivery" role="tabpanel" aria-labelledby="report-tab">
                        <table class="table table-hover text-center" name="table" name="tableSuccess">
                            <thead>
                            <tr>
                                <th scope="col">Product List ID</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Confirm</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($delivery as $deli)
                                <tr>
                                    <td>{{$deli->order_number}}</td>
                                    <td>
                                        <a href="{{ route('order.show',['order' => $deli->order_number]) }}">
                                            <button name="showDetailBtn" type="button" class="btn btn-outline-primary">Show detail</button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('order.confirm.update', ['order' => $deli->order_number]) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <button name="deleteBtn" class="btn btn-outline-success btn-lg" type="submit">Confirm</button>
                                        </form>
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
