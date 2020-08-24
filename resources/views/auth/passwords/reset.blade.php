@extends('layouts.frontend')

@section('content')

<!--  login from  section -->
<section class="login-form fixdfull-section bgclr-litegry padding-50bottom padding-50top">
	<div class="container ">
		<div class=" login-max">
          <form action="{{route('password.reset')}}" method="POST" class="login-formwrp  bgclr-green">
            @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <span class="top-postion-logo"><img src="{{ asset('assets/images/ntb-logo.png') }}"></span>
                <h3 class="padding-30bottom textclr-wit ">Reset Password</h3>
                <div class="col-from">
                    <label class="flex">Email Address <span class="strik">*</span></label>
                    <input class="inputs" placeholder="Enter Your Email Address" name="email" type="email"
                        value="{{$email}}">
                    @error('email')
                    <span style="color:red" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                </div>
                <div class="col-from">
                    <label class="flex">Password <span class="strik">*</span></label>
                    <input class="inputs show_password_field" placeholder="Enter Your Password" name="password"
                        type="password">
                    <span class="show_password">show</span>
                    @error('password')
                    <span style="color:red" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                </div>
                <div class="col-from">
                    <label class="flex">Confirm Password <span class="strik">*</span></label>
                    <input class="inputs show_password_field" placeholder="Enter Your Password"
                        name="password_confirmation" type="password">
                    <span class="show_password">show</span>
                    @error('password_confirmation')
                    <span style="color:red" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror

                </div>

                <div class="width100 flex flex-justify-between">

                    <div class="width100 submit-btn ">
                        <input type="submit" value="Reset Password"
                            class="submit btn-secondary bgclr-wit textclr-green border-none" name="submit">
                    </div>
                </div>
                @if (session('status'))
                <span class="sub-text" style="font-size: 16px">{{ session('status') }}</span>
                @endif
            </form>
        </div>
    </div>
</section>
@endsection