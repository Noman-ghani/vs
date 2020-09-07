<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;

class CategoriesController extends FrontController
{
    private $category;

    public function __construct(Categories $category)
    {
        
        $this->category = $category;
        $this->message = [];
    }

    public function browse(Request $request)
    {
        
        $record = (int)$request->get('record');
        $sortRequest = $request->get('sort');
        $sortOrder = $request->get('sort_order') == 'true' ? 'desc' : 'asc';
        
        $results = $this->category->select('id', 'title','short_code','created_at')->where('is_deleted',0);

        
        if($request->get('id')){
            $results->where('id',$request->get('id'));
        }

        if ($request->get('name')) {
            $results->where('title', 'like', '%' . $request->get('name') . '%');
        }

        if($request->get('created_at')){
            $created_at_request = $request->get('created_at').'%';
            $results->where('created_at', 'like', $created_at_request);
        }
        if ($sortRequest) {
                $results->orderBy($sortRequest, $sortOrder);
        }else{
                $results->orderBy('id', 'desc');
        }
        
        $results =  $results->paginate($record);

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

    public function get_by_id($id)
    {
    
        $results = $this->category
            ->where('id', $id)
            ->first();
        return $results;
    }
    public function store(Request $request)
    {

        $TMP_validation = [
            
        ];
        $validator = Validator::make($request->all(), $TMP_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }else{
            $short_code =  str_replace(' ', '_', strtolower($request->title));
            $categoryData = array(
                'title'   => $request->title,
                'short_code' => $short_code,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            
            $this->category->insert($categoryData);
        }
        
        return response()->json(['success' => true], 200);
    }

    public function update_by_id(Request $request, $id)
    {
        $this->category = $this->category->find($id);
        $this->category->fill($request->all());

        $TMP_validation = [
            'title' => 'required',
        ];
        $validator = Validator::make($request->all(), $TMP_validation,$this->message);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }else{
            $this->category->save();
           
        }
        return response()->json(['success' => true], 200);
    }

    public function soft_delete_by_id(Request $request, $id)
    {
         $this->category =  $this->category->find($id);
         $this->category->is_deleted = 1;
         $this->category->save();
    }

}
