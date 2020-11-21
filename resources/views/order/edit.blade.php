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
                        <a class="nav-link active" id="cart-tab" data-toggle="tab" href="#wait" role="tab" aria-controls="cart" aria-selected="true"><i class="fas fa-spinner"></i> Confirm Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="delivey-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="wait" aria-selected="false"><i class="fas fa-truck fa-fw"></i> Delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="success-tab" data-toggle="tab" href="#success" role="tab" aria-controls="success" aria-selected="false"><i class="fas fa-clipboard-check"></i> Success</a>
                    </li>
                </ul>
            </div>
            <div class="card-body table-responsive ">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="wait" role="tabpanel" aria-labelledby="report-tab">
                        <table class="table table-hover text-center" name="tableCart">
                            <thead>
                            <tr>
                                <th scope="col">Order Number</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Confirm</th>
                                <th scope="col">Delete</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($waits as $wait)
                                <tr>
                                    <td>{{$wait->order_number}}</td>
                                    <td>
                                        <a href="{{ route('order.show',['order' => $wait->id]) }}">
                                            <button name="showDetailBtn" type="button" class="btn btn-outline-primary">Show detail</button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('order.delivery.update', ['order' => $wait->id]) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <button name="deleteBtn" class="btn btn-outline-success btn-lg" type="submit"><i class="fas fa-check-square"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('order.delete.num', ['order' => $wait->id]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button name="deleteBtn" class="btn btn-outline-danger btn-lg" type="submit"><i class="fas fa-trash-alt"></i></button>
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
                                <th scope="col">Order Number</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Confirm</th>

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
                                    <td>
                                        <form action="{{ route('order.confirm.update', ['order' => $deli->id]) }}" method="post">
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
                    <div class="tab-pane fade show " id="success" role="tabpanel" aria-labelledby="report-tab">
                        <table class="table table-hover text-center" name="table" name="tableSuccess">
                            <thead>
                            <tr>
                                <th scope="col">Order Number</th>
                                <th scope="col">Detail</th>
                                <th>
                                    <form  class="float-right" action="{{ route('order.search') }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <label for="date">Date</label>
                                        <input data-provide="datepicker" id="date" type="text" name="date">
                                        <button type="submit"  for="date" name="orderBtn" class="btn btn-primary float-right  " >Search</button>
                                    </form>

                                </th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($success as $suc)
                                <tr>
                                    <td>{{$suc->order_number}}</td>
                                    <td>
                                        <a href="{{ route('order.show',['order' => $suc->id]) }}">
                                            <button name="showDetailBtn" type="button" class="btn btn-outline-primary">Show detail</button>
                                        </a>
                                    </td>
                                    <td>
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
