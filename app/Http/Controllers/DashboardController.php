<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Helpers\GeneralHelper;

class DashboardController extends Controller
{
    public function getDashboadData(Request $request)
    {
        
        $results = \App\Models\Students::select(DB::raw("(COUNT(id)) as totalRegister"),
            DB::raw("sum(case when active = 1 then 1 else 0 end) isStudent"),
            DB::raw("sum(case when active = 0 then 1 else 0 end) nonStudent")

        );
        
        $bardata = \App\Models\Students::select(
            DB::raw("(COUNT(id)) as registered"),
            DB::raw("sum(case when active = 1 then 1 else 0 end) is_student"),
            DB::raw("sum(case when active = 0 then 1 else 0 end) non_student"),
            DB::raw("sum(case when province = 1 then 1 else 0 end) from_province"),
            DB::raw("DATE_FORMAT(created_at, '%b') as monthname"),
            DB::raw("DATE_FORMAT(created_at, '%y %m') as monthId")
        )->orderBy('monthId','asc');

        $pieData = \App\Models\Students::select(
            DB::raw("(COUNT(students.id)) as registered"),
            DB::raw("states.title")
        )
        ->join('states','students.province','=','states.id')->where('is_deleted',0);
        
        if($request->daterange['startDate'] && $request->daterange['endDate']){
            
            $TMP_date_range			= GeneralHelper::split_date_range( $request->daterange );
            
            $results->whereRaw("CAST(created_at AS DATE) between '". $TMP_date_range[0] ."' and '". $TMP_date_range[1] ."' ");
            
            $bardata->whereRaw("CAST(created_at AS DATE) between '". Carbon::parse($TMP_date_range[1])->subMonth(12) ."' and '". $TMP_date_range[1] ."' ");
            
        }

        $bardata = $bardata->where('is_deleted',0)->groupBy('monthname')
        ->get()
        ->toArray();

        $pieData = $pieData->groupBy('province')
        ->get()
        ->toArray();

        $results = $results->where('is_deleted',0)->first();

        
        $result = [
            'results' => $results,
            'bardata' => $bardata,
            'pieData' => $pieData
        ];
        return response()->json($result);
    }
}


