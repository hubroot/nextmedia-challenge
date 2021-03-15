@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <create-product :categories="{{ \App\Models\Category::all() }}"></create-product>
        </div>
    </div>
</div>
@endsection
