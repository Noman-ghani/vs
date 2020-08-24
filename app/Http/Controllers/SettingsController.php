<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    private $settings;

    public function __construct(Settings $settings){
        $this->settings = $settings;
    }

    public function browse(Request $request){
        $results = $this->settings::get();

        return response()->json($results);
    }

    public function store(Request $request){
        // dd($request);
        $TMP_validation = [
            'module2_time'                => 'required',
            'module3_time'                => 'required',
        ];
        $validator = Validator::make($request->all(), $TMP_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }else{
            $finalData = array();
            foreach ($request->all() as $res) {
                // dd($res);
               
                array_push(
                    $finalData,
                    array(
                'short_code'    => $res['short_code'],
                'config'        => $res['value'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
                )
                );
            }
            $this->settings->insert($finalData);
        }
        return response()->json(['success' => true], 200);
    }

}
