@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($types as $type)
            $type->name
        @endforeach
    </div>
@endsection
