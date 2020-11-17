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
                {{ $item->name }}

            </div>
        </div>
    </div>
@endsection
