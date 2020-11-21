@extends('layouts.app')

@section('content')
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('order.edit') }}">
                        <button type="button" class="btn btn-info"> <i class="fas fa-arrow-left"></i> </button>
                    </a>
                    @else
                        <a href="{{ route('order.index') }}">
                            <button type="button" class="btn btn-info"> <i class="fas fa-arrow-left"></i> </button>
                        </a>
                    @endif

                    <button class="btn btn-link " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Products
                    </button>
                </h5>

            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="tab-pane fade show " id="wait" role="tabpanel" aria-labelledby="report-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <table class="table table-hover text-center" name="tableDelivery">
                                        <thead>
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->product->name}}</td>
                                                <td>{{$order->quantity}}</td>
                                                <td>{{$order->product->price}} Baht</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-4">
                                    <h3>Contact</h3>
                                    <table class="table table-sm">
                                        <tbody>
                                        <tr>
                                            <td colspan="2">Name : </td>
                                            <td>{{ $user->name }}</td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">Phone :</td>
                                            <td>{{ $user->phone_number }}</td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">Address</td>
                                            <td>{{ $user->address }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <h3>Receipt</h3>
                                    <table class="table table-sm">
                                        <tbody>
                                        <tr>
                                            <td>total</td>
                                            <td colspan="2"></td>
                                            <td class="text-right">{{number_format($total)}}</td>
                                        </tr>
                                        <tr >
                                            <td>vat 7%</td>
                                            <td colspan="2"></td>
                                            <td class="text-right">{{number_format($total*0.07)}}</td>
                                        </tr>
                                        <tr>
                                            <td>delivery</td>
                                            <td colspan="2"></td>
                                            <td class="text-right">{{number_format(80)}}</td>
                                        </tr>
                                        <tr >
                                            <td>total</td>
                                            <td colspan="2"></td>
                                            <td class="text-right">{{number_format($total*0.07+$total+80)}} Baht</td>
                                        </tr>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
