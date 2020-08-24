<template>
    <div>
        <section class="content-header">
            <b-container fluid>
                <b-row class="mb-2">
                    <b-col sm="6">
                        <h1 v-if="this.$route.params.id">Edit Student</h1>
                        <h1 v-else>Add Student</h1>
                    </b-col>
                    <b-col class="col-sm-6">
                        <router-link to="/doctors" v-if="this.$route.params.id" class="btn btn-success float-right">Go Back</router-link>
                    </b-col>
                </b-row>
            </b-container>
        </section>
        <section class="content">
            <b-form v-on:submit.prevent="addStudent">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                <b-form-group
                label="Are You A Student: *"
                label-for="are_you_doctor"
                class="col-sm-12">
                <div class="col-sm-12 row">
                        <b-form-radio v-model="post.are_you_doctor" @change="isStudent(true)" name="are_you_doctor" class="col-sm-1" value="1">Yes</b-form-radio>
                        <b-form-radio v-model="post.are_you_doctor" @change="isStudent(false)" name="are_you_doctor" class="col-sm-1" value="0">No</b-form-radio>
                </div>
                </b-form-group>
            <b-form-group
                id="fname-group"
                label="First Name: *"
                label-for="firstname"
                class="col-sm-6">
                <b-form-input
                id="firstname"
                v-model="post.firstname"
                type="text"
                placeholder="Enter First Name"
                ></b-form-input>
                <span v-if="error.firstname" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.firstname[0]}}</span>
            </b-form-group>
            <b-form-group
                id="lname-group"
                label="Last Name: *"
                label-for="lname"
                class="col-sm-6">
                <b-form-input
                id="lastname"
                v-model="post.lastname"            
                type="text"
                placeholder="Enter Last Name"
                ></b-form-input>
            <span v-if="error.lastname" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.lastname[0]}}</span>
            </b-form-group>
            <b-form-group
                id="email-group"
                label="Email: *"
                label-for="email"
                class="col-sm-6">
                <b-form-input
                id="email"
                v-model="post.email"
                type="email"
                placeholder="Enter email address"
                ></b-form-input>
            <span v-if="error.email" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.email[0]}}</span>
            </b-form-group>
            <b-form-group
                id="mobile-group"
                label="Mobile: *"
                label-for="mobile"
                description="It should be of 10 digits"
                class="col-sm-6">
                <b-input-group class="position-relative has-icon-left mb-3">
                    <template v-slot:prepend>
                        <b-input-group-text>+92</b-input-group-text>
                    </template>
                    <b-form-input
                    id="mobile"
                    v-model="post.mobile_no"
                    type="number"

                    placeholder="Enter mobile number"
                    ></b-form-input>
                </b-input-group>
            <span v-if="error.mobile_no" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.mobile_no[0]}}</span>
            </b-form-group>
             <b-form-group
                id="alt-contact-group"
                label="Alternate Contact:"
                label-for="alt_contact"
                description="It should be of 10 digits"
                class="col-sm-6">
                <b-input-group class="position-relative has-icon-left mb-3">
                    <template v-slot:prepend>
                        <b-input-group-text>+92</b-input-group-text>
                    </template>
                    <b-form-input
                    id="alt_contact"
                    v-model="post.alternate_contact_no"
                    type="number"
                    placeholder="Enter alternate contact number"
                    ></b-form-input>
                </b-input-group>
            <span v-if="error.alternate_contact_no" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.alternate_contact_no[0]}}</span>
            </b-form-group>
             <b-form-group
                id="cnic-group"
                label="CNIC: *"
                label-for="cnic"
                description="It should be of minimum 13 digits."
                class="col-sm-6">
                <b-form-input
                id="cnic"
                v-model="post.cnic"
                type="text"
                placeholder="42010-*******-3"
                ></b-form-input>
            <span v-if="error.cnic" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.cnic[0]}}</span>
            </b-form-group>
            <b-form-group
                id="province-group"
                label="Province: *"
                label-for="province"
                class="col-sm-6">
                <b-form-select
                id="province"
                v-model="post.province"
                type="text"
                @change="getCities()"
                placeholder="Enter province"
                >
                <b-form-select-option value="">Select Province</b-form-select-option>
                <b-form-select-option v-for="(data,idx) in province_options" :key="idx" :value="data.id">
                        {{ data.title }}
                </b-form-select-option>
                </b-form-select>
            <span v-if="error.province" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.province[0]}}</span>
            </b-form-group>
            <b-form-group
                id="district-group"
                label="District: *"
                label-for="district"
                class="col-sm-6">
                <b-form-select
                id="district"
                v-model="post.district"
                type="text"
                placeholder="Enter district"
                >
                 <b-form-select-option value="">Select District</b-form-select-option>
                <b-form-select-option v-for="(data,idx) in district_options" :key="idx" :value="data.id">
                        {{ data.title }}
                </b-form-select-option>
                </b-form-select>
            <span v-if="error.district" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.district[0]}}</span>
            </b-form-group>
            <b-form-group
                id="basic-qualification-group"
                label="Basic Qualification: *"
                label-for="basic_qualification"
                :class="half_col">
                <b-form-select
                id="basic_qualification"
                :select-size="4"
                v-model="post.basic_qualification"
                @change="onQualification"
                multiple>
                <b-form-select-option v-show="post.are_you_doctor === '0'" v-for="(data) in non_dr_qualification" :key="Math.random()*100" :value="data.value">
                        {{ data.title }}
                </b-form-select-option>
                <b-form-select-option v-show="post.are_you_doctor === '1'" v-for="(data) in dr_qualification" :key="Math.random()*100" :value="data.value">
                        {{ data.title }}
                </b-form-select-option>
                </b-form-select>
                <span v-if="error.basic_qualification" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.basic_qualification[0]}}</span>
            </b-form-group>
            <b-form-group
                id="fname-group"
                label="Other (Specify): *"
                label-for="other"
                v-show="post.basic_qualification.includes('other')"
                class="col-sm-6">
                <b-form-input
                id="other"
                v-model="post.other_qualification"
                type="text"
                placeholder="Enter Other Specify"
                ></b-form-input>
                <span v-if="error.other_qualification" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.other_qualification[0]}}</span>
            </b-form-group>
            <div class="input-group" v-show="post.are_you_doctor === '1'">
                <b-form-group
                    id="workplace_group"
                    label="Workplace type: *"
                    label-for="workplace"
                    class="col-sm-6">
                    <b-form-select
                    id="workplace"
                    v-model="post.workplace_type">
                    <b-form-select-option value="" >Select Workplace</b-form-select-option>
                        <b-form-select-option v-for="(data,idx) in workplace_options" :key="idx" :value="data.value">
                            {{ data.title }}
                        </b-form-select-option>
                    </b-form-select>
                    <span v-if="error.workplace_type" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.workplace_type[0]}}</span>
                </b-form-group>
                <b-form-group
                    id="ghospital_address_group"
                    label="Address Of Government Hospital: *"
                    label-for="ghospital_address"
                    v-show="post.workplace_type === 'government'"
                    class="col-sm-6">
                    <b-form-input
                    id="ghospital_address"
                    v-model="post.address_government_hospital"
                    type="text"
                    placeholder="Street addres, city, & etc"
                    ></b-form-input>
                    <span v-if="error.address_government_hospital" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.address_government_hospital[0]}}</span>
                </b-form-group>
                <b-form-group
                    id="phospital_address_group"
                    label="Address Private Hospital/Clinic: *"
                    label-for="phospital_address"
                    v-show="post.workplace_type === 'private'"
                    class="col-sm-6">
                    <b-form-input
                    id="phospital_address"
                    v-model="post.address_private_hospital"
                    type="text"
                    placeholder="Street addres, city, & etc"
                    ></b-form-input>
                    <span v-if="error.address_private_hospital" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.address_private_hospital[0]}}</span>
                </b-form-group>
                
                <b-form-group
                    id="work_experience_group"
                    label="Experience Of Your Work: *"
                    label-for="work_experience"
                    class="col-sm-6">
                    <b-form-select
                    id="work_experience"
                    v-model="post.work_experience">
                    <b-form-select-option value="" >Select Experience</b-form-select-option>
                        <b-form-select-option v-for="(data,idx) in work_exp_options" :key="idx" :value="data.value">
                            {{ data.title }}
                        </b-form-select-option>                    
                    </b-form-select>
                    <span v-if="error.work_experience" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.work_experience[0]}}</span>
                </b-form-group>
                <b-form-group
                    id="pmdc_registration_group"
                    label="PMDC Registration Card No:"
                    label-for="pmdc_registration"
                    description="PMDC number will be required at the time of certificate"
                    class="col-sm-6">
                    <b-form-input
                    id="pmdc_registration"
                    v-model="post.pmdc_registration_number"
                    type="text"
                    placeholder="Enter PMDC registration card no eg (1234-P)"
                    ></b-form-input>
                    <span v-if="error.pmdc_registration_number" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.pmdc_registration_number[0]}}</span>
                </b-form-group>
        
                <div class="form-group input-group col-sm-6">
                            <label class="w-100">Upload PMDC Card</label>
                        <div class="custom-file">
                            <span class="custom-file-label" for="inputFileUpload">{{ chooseFile }}</span>
                            <input type="file" 
                            accept=".jpg,.jpeg,.gif,.png"
                            name="filename" class="custom-file-input" id="inputFileUpload"
                                   @change="onImageChange">
                        </div>
                        <span class="w-100 small">(jpeg,jpg,png) max-size = 1000kb</span>
                    <span v-if="error.image" class="text-danger w-100 direct-chat-name">{{ error.image[0]}}</span>

                </div>
            </div>
            <b-form-group
                id="password_group"
                label="Password: *"
                label-for="password"
                class="col-sm-6">
                <b-form-input
                id="password"
                v-model="post.password"
                type="password"
                placeholder="Enter password"
                ></b-form-input>
                <span v-if="error.password" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.password[0]}}</span>
            </b-form-group>
            <b-form-group
                id="confirm_password_group"
                label="Confirm Password: *"
                label-for="confirm_password"
                class="col-sm-6">
                <b-form-input
                id="confirm_password"
                v-model="post.password_confirmation"
                type="password"
                placeholder="Enter confirm password"
                ></b-form-input>
                <span v-if="error.password_confirmation" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.password_confirmation[0]}}</span>
            </b-form-group>
            </div>
            </div>
            <div class="card-footer">
                <b-button type="submit" variant="success"><i class="fa fa-check"></i> Submit</b-button>
                <b-button v-if="!this.$route.params.id" @click="resetFields()" variant="danger">Reset</b-button>
            </div>
            
            </div>
            </b-form>
        </section>
  </div>
</template>
<script>
    export default {
        data: function () {
            return {
                post:{
                    role_id: 2,
                    are_you_doctor: "1",
                    firstname: '',
                    lastname: '',
                    email: '',
                    mobile_no: '',
                    alternate_contact_no: '',
                    province: '',
                    district: '',
                    basic_qualification: [],
                    other_qualification: '',
                    workplace_type: '',
                    address_government_hospital: '',
                    address_private_hospital: '',
                    work_experience: '',
                    cnic: '',
                    pmdc_registration_number: '',
                    password: '',
                    password_confirmation: '',
                },
                image: '',
                error: [],
                half_col: 'col-sm-12',
                province_options: [],
                district_options: [],
                workplace_options: [{
                        value: 'government',
                        title: 'Government Hospital',
                    },{
                        value: 'private',
                        title: 'Private Hospital/Clinic',
                    }
                ],
                work_exp_options: [{
                        value: '0_4_years',
                        title: '0-4 Years',
                    },{
                        value: '5_9_years',
                        title: '5-9 Years',
                    },{
                        value: '10+_years',
                        title: '10+ Years',
                    }
                ],
                non_dr_qualification: [{
                        value: 'graduation',
                        title: 'Graduation',
                    },{
                        value: 'master_degree',
                        title: 'Master Degree',
                    },{
                        value: 'other',
                        title: 'Other (specify)',
                    }
                ],
                dr_qualification: [{
                        value: 'MBBS',
                        title: 'MBBS',
                    },{
                        value: 'post_graduation',
                        title: 'Post Graduation',
                    },{
                        value: 'master_degree',
                        title: 'Master Degree',
                    },{
                        value: 'phd',
                        title: 'PhD',
                    },{
                        value: 'other',
                        title: 'Other (specify)',
                    },
                ],
                chooseFile: ""
            }
        },
        created: function () {
            this.getStates();
            if(this.$route.params.id){
                 this.fetchDataByID();
            }
        },
        computed: {
            isDisabled() {
                if(this.$route.params.id){
                    return true;
                }
            }
        },
        methods: {
            fetchDataByID: function() {
                 let loader = this.$loading.show();
               axios.get('/doctor/edit/'+this.$route.params.id)
                .then(response => {
                    loader.hide();
                    console.log(response.data)
                    this.post = response.data;
                    if(this.post.are_you_doctor == 1){
                        this.post.are_you_doctor = "1";
                    }else{
                        this.post.are_you_doctor = "0";
                    }
                    console.log(response.data);
                    
                    this.post.firstname = response.data.user.firstname;
                    this.post.lastname = response.data.user.lastname;
                    this.post.email = response.data.user.email;
                    this.post.basic_qualification = response.data.basic_qualification.split(",");
                    this.post.province = response.data.province;
                    this.post.district = response.data.district;
                    this.post.workplace_type = response.data.workplace_type;
                    this.post.work_experience = response.data.work_experience;
                    if(response.data.address_government_hospital == "null"){
                        this.post.address_government_hospital = null;
                    }
                    if(response.data.address_private_hospital == "null"){
                        this.post.address_private_hospital = null;
                    }
                    this.post.password = '';
                    this.post.password_confirmation = '';
                    this.image = response.data.image;
                    this.chooseFile = response.data.image;
                    this.getCities();
                    this.onQualification();
                    
                });
            },
            getStates: function(){
                let loader = this.$loading.show();
              axios.get('/getStates')
              .then(function (response) {
                 this.province_options = response.data;
                 loader.hide();
              }.bind(this));
            
            },
            getCities: function() {
                let loader = this.$loading.show();
                axios.get('/getCities',{
                 params: {
                   province_options: this.post.province
                 }
              }).then(function(response){
                    this.district_options = response.data;
                    loader.hide();
                }.bind(this));
            },
            onQualification: function () {
                console.log(this.post.basic_qualification.includes('other'));
                
                if(this.post.basic_qualification.includes('other')){
                    this.half_col = "col-sm-6";
                }else{
                    this.half_col = "col-sm-12";
                }
            },
            addStudent: function (div) {
               let loader = this.$loading.show({

               });
                console.log(this.post.basic_qualification);
                
               var url = '/doctor/add'
                    if(this.$route.params.id){
                        url = '/doctor/edit/'+this.$route.params.id
                    }
                const formData = new FormData();
                if(this.$route.params.id){
                    formData.append('user_id', this.post.user_id);
                }
                formData.append('image', this.image);
                formData.append('role_id', this.post.role_id);
                formData.append('are_you_doctor', this.post.are_you_doctor);
                formData.append('firstname', this.post.firstname);
                formData.append('lastname', this.post.lastname);
                formData.append('email', this.post.email);
                formData.append('mobile_no', this.post.mobile_no);
                console.log(typeof(this.post.alternate_contact_no));
                formData.append('alternate_contact_no', this.post.alternate_contact_no);
                formData.append('province', this.post.province);
                formData.append('district', this.post.district);
                formData.append('basic_qualification', this.post.basic_qualification);
                formData.append('other_qualification', this.post.other_qualification);
                formData.append('workplace_type', this.post.workplace_type);
                formData.append('address_government_hospital', this.post.address_government_hospital);
                formData.append('address_private_hospital', this.post.address_private_hospital);
                formData.append('work_experience', this.post.work_experience);
                formData.append('cnic', this.post.cnic);
                formData.append('pmdc_registration_number', this.post.pmdc_registration_number);
                formData.append('password', this.post.password);
                formData.append('password_confirmation', this.post.password_confirmation);
                
                axios.post(url,formData)
                .then((res) => {
        
                    this.error = '';
                    loader.hide();
                    if(this.$route.params.id){
                     this.$root.$emit('alertify', {type: 'success', message: 'Student updated Successfully'});
                    }else{
                        this.$root.$emit('alertify', {type: 'success', message: 'Student added Successfully'});
                    }
                    this.$router.push({ name: "doctor" });
                })
                .catch((err) => {
                    this.error = err.response.data.errors
                    loader.hide();
                    
                })
            },
            onImageChange(e){
                
                this.image = e.target.files[0];
                this.chooseFile = this.image.name;
            },
            resetFields: function () {
                this.error = '';
                this.post.firstname =  '';
                this.post.lastname =  '';
                this.post.email =  '';
                this.post.mobile_no =  '';
                this.post.alternate_contact_no =  '';
                this.post.province =  '';
                this.post.district =  '';
                this.post.basic_qualification = [];
                this.post.other_qualification =  '';
                this.post.workplace_type =  '';
                this.post.address_government_hospital =  '';
                this.post.address_private_hospital =  '';
                this.post.work_experience =  '';
                this.post.cnic =  '';
                this.post.pmdc_registration_number =  '';
                this.post.password =  '';
                this.post.password_confirmation =  ''

            },
            isStudent: function ($status) {
                console.log(this.post.firstname);
                
                if(this.post.firstname !=  '' || this.post.lastname !=  '' || this.post.email !=  '' || this.post.mobile_no !=  '' || this.post.alternate_contact_no !=  '' || this.post.province !=  '' || this.post.district !=  '' || this.post.basic_qualification !=  '' || this.post.other_qualification !=  '' || this.post.workplace_type !=  '' || this.post.address_government_hospital !=  '' || this.post.address_private_hospital !=  '' || this.post.work_experience !=  '' || this.post.cnic !=  '' || this.post.pmdc_registration_number !=  '' || this.post.password !=  '' || this.post.password_confirmation !=  ''){
                this.$dialog.confirm('Are you sure want to change status?', {
                    loader: true,
                    okText: 'Change',
                })
                .then((dialog) => {
                    this.resetFields();
                    dialog.close();
                })
                .catch(() => {
                    if($status){
                        this.post.are_you_doctor = "0";
                    }else{
                        this.post.are_you_doctor = "1";
                    }
                   console.log('Clicked on cancel '+this.post.are_you_doctor);
                   
                });
                }
            },
        },
        
    }
</script>