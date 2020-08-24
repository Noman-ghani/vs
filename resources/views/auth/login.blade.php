
@extends('layouts.frontend')


@section('content')
    

<!--  login from  section -->
<section class="login-form bgclr-litegry padding-50bottom padding-50top">
	<div class="container ">
		<div class=" login-max">
          <form action="/login" method="POST" id="user_login_form" class="login-formwrp  bgclr-green">
			@csrf
			<span class="top-postion-logo"><img src="{{ asset('assets/images/ntb-logo.png') }}"></span>
			<h3 class="padding-30bottom textclr-wit ">Login</h3>
		  		<div class="col-from">
            		<label class="flex">Email Address <span class="strik">*</span></label>
					<input class="inputs" placeholder="Enter Your Email Address" name="email" type="email" value="{{old('email')}}">
					@error('email')
						<span style="color:red"> {{ $message }} </span>
					@enderror
                 </div>	
                 <div class="col-from">
            		<label class="flex">Password <span class="strik">*</span></label>
            		<input class="inputs show_password_field" placeholder="Enter Your Password" name="password" type="password" >
					<span class="show_password">show</span>
					@error('password')
						<span style="color:red"> {{ $message }} </span>
					@enderror
                 </div>
                 <div class="width100 flex flex-justify-between">  		
			    <div class="col-from checkbox">
                    <div class="checkbox-row row">
                        <span class="checkbox">
                            <input type="checkbox" name="remember_me" id="remember_me" class="border ">
                            <label class="checkbox-label" for="remember_me">Remember Me</label>
                            <span class="checkmark"></span>
                        </span>
                    </div>
                </div>
                 <div class="width100 submit-btn ">
			        <input type="submit" value="Login" class="submit btn-secondary bgclr-wit textclr-green border-none" name="submit">
			    </div>
		  	</div>
		  	<div class="col-from">
                    <a href="/password/email" class="forgot-link">Did you forget username and password?</a>
                </div>
		  </form>
		  <div class="login-box bgclr-wit">
		  	<h3 class="padding-20bottom">Register for a Tuberculosis Course</h3>
		  	<p class="padding-30bottom">To strengthen programmatic and operational management capacity of the TB Control Program while enhancing public sector support for TB control by 2020.</p>
		  	<a href="register" class="btn-secondary bgclr-green textclr-wit">Register</a>
		  </div>
		</div>
	</div>
</section>

@endsection