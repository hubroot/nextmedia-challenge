@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <list-products :products="{{ $products }}" :categories="{{ $categories }}"></list-products>
        </div>
    </div>
</div>
@endsection
