@extends('layouts.app')

@section('content')
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->product->name}}</td>
                                    <td>{{$order->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
