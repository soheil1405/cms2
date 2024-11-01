
<?php

$_SESSION['page'] = 'home';

?>

@extends('master')



@section('title', ' تنوع در خرید تحول در فروش')

@section('description',
    'اینستابرق - اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس
    با ما : ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس : تهران لاله زارنو کوچه امین زاده پلاک 20')

@push('header_styles')
    @include('layouts.home.header.styles')
@endpush

@push('contents')



@if (request()->has('adminStories'))
    @include('layouts.home.openstories3')
@elseif(request()->has('vId'))
    @include('layouts.home.openstories2')
@endif

@endpush