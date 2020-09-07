<?php

namespace App\Http\Controllers;

use App\Models\Trainers;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\MailController;

class TrainersController extends Controller
{
    private $trainer;
    private $user;

    public function __construct(Trainers $trainer, User $user)
    {
        $this->trainer = $trainer;
        $this->user = $user;
        $this->message = [
            'mobile_no.regex'                           => 'Only Numbers allow.',
            'alternate_contact_no.regex'                => 'Only Numbers allow.',
            'workplace_type.required_if'                => 'Workplace type is required.',
            'address_personal_workplace.required_if'   => "Gov't hospital address is required.",
            'work_experience.required_if'               => 'Work experience is required.',
            'cnic.required'                             => 'CNIC number is required.',
            'password.required'                         => 'Password is required.',
            'password.min:8'                            => 'Password should be at least 8 charecters.',
            'image.image'                               => 'The file must be an image.',
            'firstname.regex'                           => 'Firstname contain alphabets only.',
            'lastname.regex'                            => 'Lastname contain alphabets only.',
        ];
    }

    public function browse(Request $request)
    {
        
        $record = (int)$request->get('record');
        $sortRequest = $request->get('sort');
        $sortOrder = $request->get('sort_order') == 'true' ? 'desc' : 'asc';
        
        $results = Trainers::with(['user' => function($q){
            $q->select('id', 'firstname','lastname','email', 'is_active')
            ->where('is_deleted',0);
        }])
        ->join('users','trainers.user_id','=','users.id')->where('trainers.is_deleted',0);

        
        if($request->get('firstname')){
            $results->where('firstname','like','%' . $request->get('firstname') . '%');
        }
        if($request->get('lastname')){
            $results->where('lastname','like','%' . $request->get('lastname') . '%');
        }
        if($request->get('email')){
            $results->where('email','like','%' . $request->get('email') . '%');
        }
        if($request->get('created_at')){
            $created_at_request = $request->get('created_at').'%';
            $results->where('trainers.created_at', 'like', $created_at_request);
        }
        if($request->get('cnic')){
            $results->where('cnic','like','%' . $request->get('cnic') . '%');
        }
        if($request->get('is_trainer') != null){
            $results->where('active',$request->get('is_trainer'));
        }
        
        if ($sortRequest){
            $results->orderBy($sortRequest, $sortOrder);
        }else{
            $results->orderBy('trainers.id', 'desc');
        }
        $results = $results->paginate($record);
        
        
        
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'data' => $results
        ];
        
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $TMP_validation = [
            'active'                => 'required',
            'firstname'                     => 'required|regex:/^[a-zA-Z ]+$/u',
            'lastname'                      => 'required|regex:/^[a-zA-Z ]+$/u',
            'email'                         => 'required|email|unique:App\User,email',
            'mobile_no'                     => 'required|min:10|max:11|regex:"^[0-9]*$"',
            'alternate_contact_no'          => 'nullable|min:10|max:11|regex:"^[0-9]*$"',
            'province'                      => 'required',
            'district'                      => 'required',
            'basic_qualification'           => 'required',
            'cnic'                          => 'required|unique:trainers,cnic|min:13|max:15|regex:"^[0-9-]*$"',
            'password'                      => 'required|confirmed|min:8',
            'password_confirmation'         => 'required',
            'work_experience'               => 'required_if:active,1',
            'workplace_type'                => 'required_if:active,1',
            'address_personal_workplace'    => 'required_if:workplace_type,government',
            'image'                         => 'nullable|image|mimes:jpeg,png,jpg|max:1000',
        ];
       
        $validator = Validator::make($request->all(), $TMP_validation,$this->message);
            
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()], 422);
            }else{
            
            $userData = array(
                'role_id'   => $request->role_id,
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'api_token' => Str::random(60),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            $insertedUser = $this->user->create($userData);
            if ($request->image) {
            $folder = public_path('images/trainers/' . $insertedUser->id  . '/');
           
            if (File::exists($folder)) {
                File::deleteDirectory($folder);
            }

            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0777, true, true);
            }
            
                $this->uploadImage($request,$folder);
            }
            $this->trainer->user_id = $insertedUser->id;
            $this->trainer->fill($request->all());
            $this->trainer->other_qualification = $request->other_qualification;
            $this->trainer->save();
            $name = $request->firstname. ' ' .$request->lastname;
            MailController::congratesEmail(['name' => $name, 'email' => $request->email]);
        }
        
        return response()->json(['success' => true], 200);
    }

    public function get_by_id($id)
    {
        

        $results = Trainers::with(['user' => function($q) {
            $q->select('id', 'firstname','lastname','email')
            ->where('is_deleted',0);
        }])
        ->where('user_id', $id)
        ->where('is_deleted',0);
        
        $results_final =  $results->first(); 
        // dd($results_final);
        $folder = public_path('images/trainers/' . $results_final->user->id );
        
        $image = '';
       
        if($folder){    
            foreach (glob($folder."/*.*",GLOB_NOCHECK) as $filename) {
                $filename = explode("/",$filename);
                $filename = end($filename);
                $image =  $filename ;
            }
        }
        $image = $image == "*.*" ? "" :$image;
        $results_final->setAttribute('image',$image);

        return $results_final;
    }

    public function update_by_id(Request $request, $id)
    {
        $trainer_id = $this->trainer::select('id')->where('user_id',$id)->first();
        
        $TMP_validation = [
            'active'                    => 'required',
            'firstname'                     => 'required|regex:/^[a-zA-Z]+$/u',
            'lastname'                      => 'required|regex:/^[a-zA-Z]+$/u',
            'email'                         => 'required|email|unique:App\User,email,'.$request->user_id,
            'mobile_no'                     => 'required|min:10|max:11|regex:"^[0-9]*$"',     
            'province'                      => 'required',
            'district'                      => 'required',
            'basic_qualification'           => 'required',
            'cnic'                          => 'required|min:13|max:15|regex:"^[0-9-]*$"|unique:App\Models\Trainers,cnic,'.$trainer_id->id,
            'password'                      => 'min:8|confirmed|nullable',
            'workplace_type'                => 'required_if:active,1',
            'address_personal_workplace'    => 'required_if:workplace_type,government',
            'work_experience'               => 'required_if:active,1',
            'image'                         => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ];
        if($request->alternate_contact_no && $request->alternate_contact_no != 'null'){
            $TMP_validation['alternate_contact_no'] = 'min:10|max:11|regex:"^[0-9]*$"';
        }
        $validator = Validator::make($request->all(), $TMP_validation,$this->message);
        
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()], 422);
            }else{;
                
                $usera = $this->user->where('id',$request->user_id)->first();
                $usera->firstname = $request->firstname;
                $usera->lastname = $request->lastname;
                $usera->email = $request->email;
                if($request->password != ''){
                    $usera->password = Hash::make($request->password);
                }
                $usera->save();
                if ($request->image) {
                    $folder = public_path('images/trainers/' . $request->user_id  . '/');

                    if (File::exists($folder)) {
                        File::deleteDirectory($folder);
                    }

                    if (!File::exists($folder)) {
                        File::makeDirectory($folder, 0777, true, true);
                    }
                    if (!is_string($request->image)) {
                        $this->uploadImage($request, $folder);
                    }
                }
                
                $this->trainer = $this->trainer->find($trainer_id->id);
                $this->trainer->fill($request->all());
                if($request->alternate_contact_no == "null"){
                    $this->trainer->alternate_contact_no = null;
                }
                if($request->pmdc_registration_number == "null"){
                    $this->trainer->pmdc_registration_number = null;
                }
                if($request->password == "null"){
                    $this->trainer->password = null;
                }
                $this->trainer->other_qualification = $request->other_qualification;
                $this->trainer->save();
            }
        return response()->json(['success' => true], 200);
    }

    public function uploadImage(Request $request,$path)
    {
        
        $imageName = "pmdc-card-image." . $request->image->getClientOriginalExtension();
        $request->image->move($path, $imageName);
        
    	return response()->json(['success'=>'You have successfully upload image.']);
    }

    public function soft_delete_by_id(Request $request, $id)
    {
        $this->trainer = $this->trainer->find($id);
        $this->trainer->is_deleted = 1;
        $this->trainer->save();
        
        $user = $this->user->where('id',$this->trainer->user_id)->first();
        $user->is_deleted = 1;
        $user->save();
    }

    public function distroy_by_id(Request $request, $id)
    {}
}
