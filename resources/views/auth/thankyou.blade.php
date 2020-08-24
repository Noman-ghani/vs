@extends('layouts.frontend')

@section('content')

@php
    header( "refresh:10;url=/login" );
@endphp
<!--  login from  section -->
<section class="thanks-you-page ">
	<div class="container ">
		<div class="thanks-you-box bgclr-green textclr-wit">
            <span class="check-icon"><img src="{{ asset('assets/images/check.png') }}"></span>
            <span class="top-postion-logo"><img src="{{ asset('assets/images/ntb-logo.png') }}" alt="thankyou-logo"></span>
            <h3 class="textclr-wit padding-35top padding-20bottom">Thank You,</h3>
            <p>You have successfully registered! Please check your email.</p>
	</div>
</section>

@endsection