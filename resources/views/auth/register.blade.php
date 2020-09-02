@extends('layouts.frontend')

@section('content')

<!--  login from  section -->
<section class="login-form bgclr-litegry padding-50bottom padding-50top register-page">
    <div class="container ">
        <div class=" login-max">
            <div class="login-formwrp bgclr-green">
                <span class="top-postion-logo"><img src="{{ asset('assets/images/ntb-logo.png') }}"></span>

                <h3 class="padding-30bottom textclr-wit ">Register for a Tuberculosis Course</h3>
                <div class="width100">
                    <div class="form-coltwo radio-col flex flex-justify-between flex-items-center chnage-div">
                        <label>Are You A Student? <span class="strik">*</span></label>
                        <div class="radio-wrp full-width flex ">
                            <div class="radio">
                                <input name="std_active" id="std_active_yes" type="radio" value="1" checked="checked">
                                <label for="std_active_yes" class="radio-label" for="chkYes">Yes</label>
                            </div>
                            <div class="radio">
                                <input name="std_active" id="std_active_no" type="radio" value="0">
                                <label for="std_active_no" class="radio-label">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="student">
                    <form action="/user/register" id="student_form" class="user_register_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role_id" value="2">
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">First Name: <span class="strik">*</span></label>
                                <input class="inputs alphaonly" placeholder="Enter Your First Name " name="firstname" type="text">
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">Last Name: <span class="strik">*</span></label>
                                <input class="inputs alphaonly" placeholder="Enter Your Last Name" name="lastname" type="text">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">Email Address: <span class="strik">*</span></label>
                                <input class="inputs" placeholder="abc@yourmail.com" name="email" type="email">
                            </div>
                            <div class="form-coltwo mobile">
                                <label class="flex">Mobile No:  <span class="strik">*</span> <span class="sub-text">(should be of 10-11 digits)</span></label>
                                <input class="inputs numeric" placeholder="3433068720 " name="mobile_no" type="text" maxlength="11">
                                <span class="mobile-code">+92</span>
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo mobile">
                                <label class="flex">Alternate Contact No: <span class="sub-text">(should be of 10-11 digits)</span></label>
                                <input class="inputs numeric" placeholder="3433068720" name="alternate_contact_no" type="text" maxlength="11">
                                <span class="mobile-code">+92</span>
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">CNIC: <span class="strik">*</span><span class="sub-text">(should be of 13 digits)</span></label>
                                <input class="inputs numeric" placeholder="42010*******3" name="cnic" type="text" maxlength="13">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">Province: <span class="strik">*</span></label>
                                <select name="province" >
                                    <option value="" disabled selected>Select Province</option>
                                    @foreach ($province as $key => $item)
                                        <option value="{{ $item->id }}" cities='{{$item->cities}}'>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">District: <span class="strik">*</span></label>
                                <select name="district">
                                    <option value="" disabled selected>Select District</option>
                                </select>
                            </div>
                        </div>
                        <div class="width100">
                            <div class="col-from multiple">
                                <label class="flex">Basic Qualification: <span class="strik">*</span></label>
                                <select style="display:none" name="basic_qualification" multiple placeholder="Select Qualification">
                                    <option value="MBBS">MBBS</option>
                                    <option value="post_graduation">Post Graduation</option>
                                    <option value="master_degree">Master Degree</option>
                                    <option value="phd">PhD</option>
                                    <option value="other">Other (specify)</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="width100 other_qualification" style="display: none;" >
                            <div class="col-from">
                                <label class="flex">Other (specify): <span class="strik">*</span></label>
                                <input class="inputs alphaonly" placeholder="Other" name="other_qualification"
                                    type="text">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="col-from multiple workplace_type">
                                <label class="flex">Workplace Type: <span class="strik">*</span></label>

                                <select style="display:none" name="workplace_type" multiple placeholder="Select Workplace">
                                    <option value="government">Government Hospital</option>
                                    <option value="private">Private Hospital/Clinic</option>
                                </select>
                            </div>
                        </div>
                        <div class="width100">
                            <div class="col-from" id="address_government_hospital" style="display:none">
                                <label class="flex">Address Of Government Hospital: <span class="strik">*</span></label>
                                <input class="inputs" placeholder="Street Address, City, & etc"
                                    name="address_government_hospital" type="text">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="col-from" id="address_private_hospital" style="display:none">
                                <label class="flex">Address Private Hospital/Clinic: <span class="strik">*</span></label>
                                <input class="inputs" placeholder="Street Address, City, & etc"
                                    name="address_private_hospital" type="text">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">Experience Of Your Work: <span class="strik">*</span></label>
                                <select name="work_experience">
                                    <option value="" disabled selected>Select Experience</option>
                                    <option value="0_4_years">0-4 Years</option>
                                    <option value="5_9_years">5-9 Years</option>
                                    <option value="10+_years">10+ Years</option>
                                </select>
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">PMDC Registration Card No: <span class="sub-text"></span></label>
                                <input class="inputs pmdc_no" placeholder="PMDC Registration Card No eg: (1234-P) " name="pmdc_registration_number" type="text">
                                <span class="sub-text">PMDC number will be required at the time of certificate</span>
                            </div>
                        </div>
                        <div class="width100">
                            <div class="col-from upload">
                                <label class="flex">Upload PMDC Registration Card: <span class="sub-text">(JPEG, PNG, JPG) (Max: 1000kb)</span></label>
                                <input class="inputs upload-file" name="image" type="file" accept="JPEG,PNG,JPG">
                                <span class="upload-label">Browse file from Computer</span>
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">Password: <span class="strik">*</span></label>
                                <input class="inputs show_password_field" placeholder="Must Be At Least 8 Characters"
                                    name="password" type="password">
                                <span class="show_password">show</span>
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">Confirm Password: <span class="strik">*</span></label>
                                <input class="inputs show_password_field" placeholder="Must Be At Least 8 Characters" name="password_confirmation" type="password">
                                <span class="show_password">show</span>
                            </div>
                        </div>
                        <div class="width100 flex flex-justify-between margin-20top">
                            <div class="width100 submit-btn ">
                                <input type="submit" value="Register"
                                    class="submit btn-secondary bgclr-wit textclr-green border-none" name="submit">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="none-student" style="display: none;">
                    <form action="/user/register" id="non_student_form" class="user_register_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role_id" value="2">
                        
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">First Name: <span class="strik">*</span></label>
                                <input class="inputs alphaonly" placeholder="Enter Your First Name " name="firstname" type="text">
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">Last Name: <span class="strik">*</span></label>
                                <input class="inputs alphaonly" placeholder="Enter Your Last Name" name="lastname" type="text">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">Email Address: <span class="strik">*</span></label>
                                <input class="inputs" placeholder="abc@yourmail.com" name="email" type="email">
                            </div>
                            <div class="form-coltwo mobile">
                                <label class="flex">Mobile No: <span class="strik">*</span> <span class="sub-text">(should be of 10-11 digits)</span></label>
                                <input class="inputs numeric" placeholder="3433068720" name="mobile_no" type="text" maxlength="11">
                                <span class="mobile-code">+92</span>
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo mobile">
                                <label class="flex">Alternate Contact No: <span class="sub-text">(should be of 10-11 digits)</span></label>
                                <input class="inputs numeric" placeholder="3433068720" name="alternate_contact_no" type="text" maxlength="11">
                                <span class="mobile-code">+92</span>
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">CNIC: <span class="strik">*</span><span class="sub-text">(should be of 13 digits)</span></label>
                                <input class="inputs numeric" placeholder="42010*******3" name="cnic" type="text" maxlength="13">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">Province: <span class="strik">*</span></label>
                                <select name="province" >
                                    <option value="" disabled selected>Select Province</option>
                                    @foreach ($province as $key => $item)
                                        <option value="{{ $item->id }}" cities='{{$item->cities}}'>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">District: <span class="strik">*</span></label>
                                <select name="district">
                                    <option value="" disabled selected>Select District</option>
                                </select>
                            </div>
                        </div>
                        <div class="width100">
                            <div class="col-from multiple">
                                <label class="flex"> Basic Qualification: <span class="strik">*</span></label>
                                <select style="display:none" name="basic_qualification" multiple placeholder="Select Qualification">
                                    <option value="graduation">Graduation</option>
                                    <option value="master_degree">Master Degree</option>
                                    <option value="other">Other (specify)</option>
                                </select>
                            </div>
                        </div>
                        <div class="width100 other_qualification" style="display: none;">
                            <div class="col-from">
                                <label class="flex">Other (specify): <span class="strik">*</span></label>
                                <input class="inputs alphaonly" placeholder="Other" name="other_qualification" type="text">
                            </div>
                        </div>
                        <div class="width100">
                            <div class="form-coltwo">
                                <label class="flex">Password: <span class="strik">*</span></label>
                                <input class="inputs show_password_field" placeholder="Must Be At Least 8 Characters"
                                    name="password" type="password">
                                <span class="show_password">show</span>
                            </div>
                            <div class="form-coltwo">
                                <label class="flex">Confirm Password: <span class="strik">*</span></label>
                                <input class="inputs show_password_field" placeholder="Must Be At Least 8 Characters" name="password_confirmation" type="password">
                                <span class="show_password">show</span>
                            </div>
                        </div>
                        <div class="width100 flex flex-justify-between margin-20top">
                            <div class="width100 submit-btn ">
                                <input type="submit" value="Register"
                                    class="submit btn-secondary bgclr-wit textclr-green border-none" name="submit">
                            </div>
                        </div>

                    </form>
                </div>


            </div>
            <div class="login-box bgclr-wit width100">
                <p class="padding-30bottom">Already Registered? <a href="login">Sign In</a></p>
            </div>
        </div>
    </div>
</section>

@endsection