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
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" class="form-control-file  btn-primary" name="file" id="exampleFormControlFile1">
                        </div>
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" name="name"   placeholder="">

                        <label for="price " class="justify-content-center">Price</label>
                        <input type="number" min="0" class="form-control" id="price" name="price"  placeholder="">

                        <label for="type">Type</label>
                        <select class="form-control" name="type">
                            <option value="VARVEL">VARVEL</option>
                            <option value="EXPLOSION PROOF MOTORS">EXPLOSION PROOF MOTORS</option>
                            <option value="AC INDUCTION MOTORS">AC INDUCTION MOTORS</option>
                            <option value="HELICAL GEAR">HELICAL GEAR</option>
                            <option value="WORM GEAR SPEED REDUCER">WORM GEAR SPEED REDUCER</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <textarea class="form-control" id="detail" rows="3" name="detail" ></textarea>
                    </div>
                    <button type="submit"  name="orderBtn" class="btn btn-outline-success float-right"><i class="fas fa-edit"></i>Create</button>

                </form>

            </div>
        </div>
    </div>
@endsection
