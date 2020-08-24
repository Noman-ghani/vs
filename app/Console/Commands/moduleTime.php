<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DoctorsTimespentLogs;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use App\Http\Controllers\MailController;

class moduleTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moduleTime:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $results = DoctorsTimespentLogs::join('doctors','doctors.user_id','=','doctors_timespent_logs.user_id')
        ->where('doctors.is_deleted',0)
        ->join('users','doctors.user_id','=','users.id')
        ->where('doctors_timespent_logs.ended_at','!=',null)
        ->get();
        dd($results);
        foreach($results as $res){
            $date1 = Carbon::now();
            $date2 = $res->ended_at;
            $diff = $date1->diffInMinutes($date2);
            $setting = null;
            if($res->module_id == 1){
                $setting = Settings::where('short_code','module_2_start')->first();
            }else if($res->module_id == 2){
                $setting = Settings::where('short_code','module_3_start')->first();
            }else if($res->module_id == 3){
                $setting = Settings::where('short_code','module_4_start')->first();
            }else if($res->module_id == 4){
                $setting = Settings::where('short_code','module_5_start')->first();
            }else if($res->module_id == 5){
                $setting = Settings::where('short_code','module_6_start')->first();
            }else if($res->module_id == 6){
                $setting = Settings::where('short_code','module_7_start')->first();
            }
            if($diff >= $setting->config){
                // dd(12);
                $to['name'] = $res->firstname.' '.$res->lastname;
                $to['email'] = $res->email;
                $data = "testing nitesh module time stamp";
                $sentEmail = MailController::sendEmail($to, 'New Module Started', $data);
            }
           
        }
    }
}

