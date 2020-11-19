@extends('layouts.app')

@section('content')
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    @if(auth()->user() === 'user')
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

                        <table class="table table-hover text-center" name="tableDelivery">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Amount</th>
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
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td colspan="3">{{ $total }} Baht</td>
                            </tr></tfoot>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
