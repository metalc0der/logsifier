<?php

namespace Metalcoder\Logsifier\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Metalcoder\Logsifier\Models\Log;
use App\Http\Controllers\Validator;
use Carbon\Carbon;
use Excel;
use Auth;
use Mail;

class MetalcoderLogsifierController extends Controller {

    protected function rules() {

        return [
            'user_id' => 'required|numeric',
            'ip' => 'required',
            'log_date' => 'required',
            'order_date' => 'required',
            'object' => 'required',
            'object_id' => 'required|numeric',
            
        ];

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * 
     * 
     */
    public function store($ip,$object,$object_id,$description,$source,$urgent = false)
    {
      

        $log = Log::create(['user_id' => Auth::check() ? Auth::user()->id : 0,
                            'ip' => $ip,
                            'log_date' => Carbon::now(),
                            'object' => $object,
                            'object_id' => $object_id,
                            'description' => $description,
                            'source' => $source,

                            ]);

        if($urgent) {

            $html = "<h3>Your application has registered a severe log entry !!!</h3";
            $html = $html."<p>User: ".$log->user_id."</p>";
            $html = $html."<p>IP: ".$log->ip."</p>";
            $html = $html."<p>Date: ".$log->log_date."</p>";
            $html = $html."<p>Object: ".$log->object."</p>";
            $html = $html."<p>Object Id: ".$log->object_id."</p>";
            $html = $html."<p>Description: ".$log->description."</p>";
            $html = $html."<p>Source: ".$log->source."</p>";

            foreach (config('logsifier.recipients') as $email) {

                Mail::send(array(), array(), function ($message) use ($html) {
                  $message->to($email)
                    ->subject("Severe app log entry registered !!!")
                    ->from(config('logsifier.from') )
                    ->setBody($html, 'text/html');
                });

            }
            


        }

    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index() {


        return Log::orderBy('log_id', 'desc')
                    ->get();

   
    }

    /**
     * Export to CSV file.
     *
     * 
     */
    public function exportCSV() {

        $logs = Log::selectRaw("user_id,ip,log_date,object,object_id,source,description")
                    ->get();

        $this->export('Logs-'.Carbon::now()->timestamp,$logs);

   
    }

    /**
     * Rotate logs.
     *
     * 
     */
    public function rotate(Request $request) {

        if(count(Logs::all()) > 10000) {

            $this->exportCSV();
            Log::delete();

        }

   
    }

    public function export($filename,$data)
    {

        Excel::create($filename, function($excel) use($data) {

            $excel->sheet('Main', function($sheet) use($data) {

                $sheet->fromArray($data);

            });

        })->export('csv');

    }

}
