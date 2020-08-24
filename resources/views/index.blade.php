@extends('layouts.frontend')

@section('content')




<!--  Home banner section -->
<section class="banner">
	<div class="container">
	<div class="banner-wrp">
		<div class="banner-logo"><img src="{{ asset('assets/images/together-logo.png') }}"></div>
		<h2 class="padding-35bottom">Call For A Tuberculosis Free Pakistan</h2>
		<p class="padding-20bottom">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		@guest <a href="/register" class="btn-secondary bgclr-green textclr-wit margin-35bottom">Register for a TB course</a> @endguest
		<ul class="logos flex">
			<li>
				<a href="#"><img src="{{ asset('assets/images/dmc.png') }}" alt="dmc"></a>
			</li>
			<li>
				<a href="#"><img src="{{ asset('assets/images/the-global-fund.png') }}" alt="the-globalfund" class="the-globalfund"></a>
			</li>
			<li>
				<a href="#"><img src="{{ asset('assets/images/nacp.png') }}" alt="nacp"></a>
			</li>
			<li>
				<a href="#"><img src="{{ asset('assets/images/world-health.png') }}" alt="world-health"></a>
			</li>
			
		</ul>
	</div>
	</div>
</section>
<!--  Home about section -->
<section class="home-about" id="about">
	<div class="container flex">
		<div class="about-wrp">
			<p class="info-txt padding-20bottom">About NTB</p>
			<h3 class="padding-20bottom">National Tuberculosis control program will strive for Tuberculosis free Pakistan by  <strong class="strong-clor">reducing - 50%</strong> prevalence of TB in general population by 2025</h3>
			<p class="padding-20bottom">in comparison to 2012 through universal access to quality Tuberculosis care and achieving Zero Tuberculosis death. To increase the number of notified Tuberculosis cases from 298,981 in 2013 to at least 420,000 by 2020 while maintaining the treatment success rate at 91%. To reduce, by at least 5% per year by 2020. the prevalence of MDR-TB among TB patients who have never received any TB treatment. To strengthen programmatic and operational management capacity of the TB Control Program while enhancing public sector support for TB control by 2020.</p>

		</div>		
		<div class="about-wrp padding-20top padding-20left padding-20right">
			<img src="{{ asset('assets/images/pak-mape.png') }}">
		</div>		
		<div class="about-wrp padding-70top">
			<h1 class="padding-10bottom">93%</h1>
			<h3 class="padding-20bottom strong-clor">Treatment Success Rate</h3>
			<p class="padding-20bottom">To strengthen programmatic and operational management capacity of the Tuberculosis Control Program while enhancing public sector support for Tuberculosis control by 2020.</p>
			<a href="#" class="btn-secondary bgclr-green textclr-wit">Support Us</a>

		</div>
	</div>
</section>
<!--  Contact   section -->
<section class="contact bgclr-litegry padding-50bottom padding-50top" id="contact">
	<div class="container flex">
		<div class="contact-info text-center width40  bgclr-wit">
		<h3 class="padding-30bottom">Register for a Tuberculosis Course</h3>
		<p class="padding-30bottom">To strengthen programmatic and operational management capacity of the Tuberculosis Control Program while enhancing public sector support for Tuberculosis control by 2020.</p>
		@guest <a href="/register" class="btn-secondary bgclr-green textclr-wit">Register for a TB course</a>@endguest
		</div>
		<div class="contact-form width60 bgclr-green ">
			<p class="info-txt textclr-wit padding-5bottom">Contact Us</p>
			<h3 class="padding-30bottom textclr-wit">How may we help you?</h3>
		  <form>
		  	<div class="width100">
		  		 <div class="form-coltwo">
            		<label class="flex">Name  <span class="strik">*</span></label>
            		<input class="inputs" placeholder="Name " name="name" type="text" >
                 </div>
		  		<div class="form-coltwo">
            		<label class="flex">Email Address <span class="strik">*</span></label>
            		<input class="inputs" placeholder="Email Address" name="email" type="email" >
                 </div>
             </div>
                 <div class="width100">
                 	<label class="flex">Write Message <span class="strik">*</span></label>
                 	<textarea  placeholder="Message" name="message" class="inputs"></textarea>
                 </div>
                 <div class="width100 submit-btn margin-20top">
			        <input type="submit" value="Send Message" class="submit btn-secondary bgclr-wit textclr-green border-none" name="submit">
   				 </div>
		  	</div>
		  </form>
		</div>
	</div>
</section>

@endsection