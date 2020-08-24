<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\DoctorsTimespentLogs;
use App\Models\Modules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulesController extends Controller
{
    private $modules;
    
    public function __construct(Modules $modules)
    {
        $this->modules = $modules;
    }
    
    public function browse(Request $request)
    {
        $results = $this->modules
            ->select('id', 'title', 'sort', 'created_at')
            ->orderby('id', 'desc');

        if ($request->get('title')) {
            $results->where('title', 'like', '%' . $request->get('title') . '%');
        }

        return $results->get();
    }

    public function get_file_by_id($id)
    {
        $folder = public_path('images/module/'.$id);
        
        $file = '';
       
        if($folder){    
            foreach (glob($folder."/*.*",GLOB_NOCHECK) as $filename) {
                $filename = explode("/",$filename);
                $filename = end($filename);
                $file =  $filename ;
            }
        }
        $file = array(
            'file' => $file == "*.*" ? "" : $file
        );
        
        return $file;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:100'],
            'sort' => ['required', 'unique:modules']
        ]);
        
        $this->modules->fill($request->all());
        $this->modules->save();
        
        return response()->json(['success' => true], 200);
    }

    public function update_by_id(Request $request, $id)
    {
        $this->modules = $this->modules->find($id);
        $this->modules->fill($request->all());

        $request->validate([
            'title' => ['required', 'max:100'],
            'sort' => ['required', 'unique:modules,id, ' . $id]
        ]);

        $this->modules->save();
        return response()->json(['success' => true], 200);
    }

    public function updateDoctorCurrentSection(Request $request)
    {
        $request->validate([
            'module_id' => ['required', 'numeric'],
            'section_id' => ['required', 'numeric']
        ]);

        Doctors::where('user_id', Auth::id())->update($request->all());
        return response()->json(['success' => true], 200);
    }

    public function updateDoctorTimespentLog(Request $request)
    {
        $request->validate([
            'module_id' => ['required', 'numeric'],
            'type' => ['required'],
            'start_or_end' => ['required']
        ]);

        $fillCol = $request->start_or_end == "start"?"started_at":"ended_at";

        $timespent = DoctorsTimespentLogs::firstOrNew(['user_id'=> Auth::id(), 'type'=>$request->type, 'module_id'=>$request->module_id]);
        $timespent->user_id = Auth::id();
        $timespent->module_id = $request->module_id;
        $timespent->type = $request->type;
        $timespent->{$fillCol} = Carbon::now();
        $timespent->save();

        return response()->json(['success' => true], 200);
    }
}