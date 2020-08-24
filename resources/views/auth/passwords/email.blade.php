@extends('layouts.frontend')

@section('content')

<!--  login from  section -->
<section class="login-form fixdfull-section bgclr-litegry padding-50bottom padding-50top">
	<div class="container ">
		<div class=" login-max">
			<form action="{{route('password.email')}}" method="POST" class="login-formwrp  bgclr-green">
				@csrf
				<span class="top-postion-logo"><img src="{{ asset('assets/images/ntb-logo.png') }}"></span>
				<h3 class="padding-30bottom textclr-wit ">Forgot Password Email</h3>
				<div class="col-from">
					<label class="flex">Email Address <span class="strik">*</span></label>
					<input class="inputs" placeholder="Enter Your Email Address" name="email" type="email">
					@error('email')
					<span style="color:red" role="alert">
						<p>{{ $message }}</p>
					</span>
					@enderror
				</div>

				<div class="width100 flex flex-justify-between">

					<div class="width100 submit-btn ">
						<input type="submit" value="Send Reset Link"
							class="submit btn-secondary bgclr-wit textclr-green border-none" name="submit">
					</div>
				</div>
				@if (session('status'))
				<span class="sub-text" style="font-size: 16px">{{ session('status') }}</span>
				@endif
				<div class="col-from">
					<a href="/login" class="forgot-link">Back To Login</a>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection