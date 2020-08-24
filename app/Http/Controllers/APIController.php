<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\States;
use App\Models\Cities;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->message = [
            'file.mimes'                           => 'The file must be in PDF format',
        ];
    }
    public function getStates()
    {
        $data = States::get();

        return response()->json($data);
    }

    public function getStatesById($id)
    {
        $data = States::where('id',$id)->first();

        return response()->json($data['title']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getCities(Request $request)
    {
        $data = Cities::where('state_id', $request->province_options)->get();

        return response()->json($data);
    }

    public function deleteFile(Request $request){
        if ($request->module) {
            $folder = public_path('images/module/' . $request->module  . '/');
            $file = public_path('images/module/' . $request->module  . '/'.$request->file);
        }
        if (File::exists($file)){
            File::deleteDirectory($folder);
        }
        return response()->json(['success' => true], 200);
    }

    public function uploadFile(Request $request){
        
        $TMP_validation = [
            'file'                => 'required|mimes:pdf',
        ];
        $validator = Validator::make($request->all(), $TMP_validation,$this->message);
            
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }else{
            $folder = null;
            if ($request->module) {
                $folder = public_path('images/module/' . $request->module  . '/');
            }
            if (File::exists($folder)) {
                File::deleteDirectory($folder);
            }
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0777, true, true);
            }
            if (!is_string($request->file)) {
                $fileName = $request->file->getClientOriginalName();
                $request->file->move($folder, $fileName);
            }
            return response()->json(['success' => true], 200);
        }
        return response()->json(['errors' => "Something went wrong"], 422);
    }
}
