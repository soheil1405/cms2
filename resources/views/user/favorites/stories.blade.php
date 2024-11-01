@extends('user.layouts.user')

@section('title')
    index products
@endsection



<style>
    .instarang {
        background: radial-gradient(ellipse at 70% 70%, #ee583f 8%, #d92d77 42%, #bd3381 58%);
    }

    .favoriteLink {
        color: #ffff !important;
        border-radius: 10px;
        width: 20%;
        height: 100%;
        padding: 10px;

        text-decoration: none;
    }

    
</style>

@section('content')
@include('user.favorites.topMenu')
<div class="col-12   text-center " style="overflow: hidden;">

        
    <h1>
        استوری های مورد علاقه من
    </h1>
</div>
@endsection
